<?php

namespace App\Http\Controllers;

use App\Models\AssociatedTask;
use App\Models\Characteristic;
use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use App\Models\Download;
use App\Models\FeatureType;
use App\Models\Paper;
use App\Models\SubjectArea;
use App\Models\UrlFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MyDatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::where('id_user', Auth::user()->id)->get();
        return view('my-dataset', compact('datasets'));
    }

    public function show($id)
    {
        $dataset = Dataset::leftJoin('subject_areas', 'subject_areas.id', '=', 'datasets.id_subject_area')->find($id);
        $characteristics = DatasetCharacteristic::join('characteristics', 'characteristics.id', '=', 'dataset_characteristics.id_characteristic')->where('id_dataset', $id)->get();
        $featureTypes = DatasetFeatureType::join('feature_types', 'feature_types.id', '=', 'dataset_feature_types.id_feature_type')->where('id_dataset', $id)->get();
        $associatedTasks = DatasetAssociatedTask::join('associated_tasks', 'associated_tasks.id', '=', 'dataset_associated_tasks.id_associated_task')->where('id_dataset', $id)->get();
        $papers = Paper::where('id_dataset', $id)->get();
        return view('detail-my-dataset', compact(['dataset', 'characteristics', 'featureTypes', 'associatedTasks', 'papers']));
    }

    public function edit($id)
    {
        $characteristics = Characteristic::all();
        $subjectAreas = SubjectArea::all();
        $associatedTasks = AssociatedTask::all();
        $featureTypes = FeatureType::all();

        $dataset = Dataset::leftJoin('subject_areas', 'subject_areas.id', '=', 'datasets.id_subject_area')->select('datasets.id as id_dataset', 'datasets.*', 'subject_areas.*')->find($id);
        $datasetCharacteristics = DatasetCharacteristic::join('characteristics', 'characteristics.id', '=', 'dataset_characteristics.id_characteristic')->where('id_dataset', $id)->get();
        $datasetFeatureTypes = DatasetFeatureType::join('feature_types', 'feature_types.id', '=', 'dataset_feature_types.id_feature_type')->where('id_dataset', $id)->get();
        $datasetAssociatedTasks = DatasetAssociatedTask::join('associated_tasks', 'associated_tasks.id', '=', 'dataset_associated_tasks.id_associated_task')->where('id_dataset', $id)->get();
        $files = UrlFile::where('id_dataset', $id)->get();
        $papers = Paper::where('id_dataset', $id)->get();
        return view('edit-my-dataset', compact(['files', 'dataset', 'datasetCharacteristics', 'characteristics', 'featureTypes', 'datasetFeatureTypes', 'subjectAreas', 'datasetAssociatedTasks', 'associatedTasks', 'papers']));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'information' => ['required'],
            ],
            [
                'information.required' => 'The dataset information field is required',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try {
            $dataset = Dataset::findOrFail($id);
            $dataset->id_user = Auth::user()->id;
            $dataset->id_subject_area = $request->subjectArea;
            $dataset->name = $request->name;
            $dataset->abstract = $request->abstract;
            $dataset->instances = $request->instances;
            $dataset->features = $request->features;
            $dataset->status = 'pending';
            $dataset->information = $request->information;
            $dataset->update();

            if ($request->file('files')) {
                foreach ($request->file('files') as $file) {
                    $urlFiles = new UrlFile();
                    $urlFiles->id_dataset = $dataset->id;
                    $path = $file->storeAs('public/datasets/' . $dataset->id, $file->getClientOriginalName());
                    $urlFiles->url_file = str_replace('public/', '', $path);
                    $urlFiles->save();
                }
            }

            $oldCharacteristic = DatasetCharacteristic::where('id_dataset', $id)->get();
            if ($oldCharacteristic) {
                foreach ($oldCharacteristic as $value) {
                    $value->delete();
                }
            }
            foreach (str_split($request->characteristics) as $characteristic) {
                if ($characteristic != ',') {
                    $newCharacteristic = new DatasetCharacteristic();
                    $newCharacteristic->id_dataset = $id;
                    $newCharacteristic->id_characteristic = $characteristic;
                    $newCharacteristic->save();
                }
            }

            $oldAssociatedTasks = DatasetAssociatedTask::where('id_dataset', $id)->get();
            if ($oldAssociatedTasks) {
                foreach ($oldAssociatedTasks as $value) {
                    $value->delete();
                }
            }
            foreach (str_split($request->associatedTasks) as $associatedTasks) {
                if ($associatedTasks != ',') {
                    $newAssociatedTasks = new DatasetAssociatedTask();
                    $newAssociatedTasks->id_dataset = $dataset->id;
                    $newAssociatedTasks->id_associated_task = $associatedTasks;
                    $newAssociatedTasks->save();
                }
            }

            $oldFeatureType = DatasetFeatureType::where('id_dataset', $id)->get();
            if ($oldFeatureType) {
                foreach ($oldFeatureType as $value) {
                    $value->delete();
                }
            }
            foreach (str_split($request->featureTypes) as $featureType) {
                if ($featureType != ',') {
                    $newfeatureType = new DatasetFeatureType();
                    $newfeatureType->id_dataset = $id;
                    $newfeatureType->id_feature_type = $featureType;
                    $newfeatureType->save();
                }
            }

            if ($request->title) {
                $paper = new Paper();
                $paper->id_user = Auth::user()->id;
                $paper->id_dataset = $dataset->id;
                $paper->title = $request->title ?? '-';
                $paper->description = $request->description;
                $paper->url = $request->urlPaper;
                $paper->save();
            }

            if (!empty($request->removePapers)) {
                foreach ($request->removePapers as $removePaper) {
                    Paper::find($removePaper)->delete();
                }
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
                // 'message' => 'There is an error',
            ]);
        }
    }

    public function moreInfo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'abstract' => ['required'],
                'instances' => ['required', 'numeric'],
                'features' => ['required', 'numeric'],
                'characteristics' => ['nullable'],
                'subjectArea' => ['nullable'],
                'associatedTasks' => ['nullable'],
                'featureTypes' => ['nullable'],
            ],
            [
                'name.required' => 'The dataset name field is required',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'key' => $validator->errors()->keys()[0],
                'message' => $validator->errors()->first(),
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $dataset = Dataset::findOrFail($id);
            $id = $dataset->id;
            $dataset->delete();

            $characteristics = DatasetCharacteristic::where('id_dataset', $id)->get();
            foreach ($characteristics as $characteristic) {
                $characteristic->delete();
            }

            $associatedTasks = DatasetAssociatedTask::where('id_dataset', $id)->get();
            foreach ($associatedTasks as $associatedTask) {
                $associatedTask->delete();
            }

            $featureTypes = DatasetFeatureType::where('id_dataset', $id)->get();
            foreach ($featureTypes as $featureType) {
                $featureType->delete();
            }

            $downloads = Download::where('id_dataset', $id)->get();
            foreach ($downloads as $download) {
                $download->delete();
            }

            $papers = Paper::where('id_dataset', $id)->get();
            foreach ($papers as $paper) {
                $paper->delete();
            }

            $urlFiles = UrlFile::where('id_dataset', $id)->get();
            foreach ($urlFiles as $urlFile) {
                Storage::delete('public/' . $urlFile->url_file);
                $urlFile->delete();
            }
            DB::commit();

            $datasets = Dataset::where('id_user', Auth::user()->id)->get();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
                'datasets' => $datasets,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
