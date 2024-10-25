<?php

namespace App\Http\Controllers;

use App\Models\AssociatedTask;
use App\Models\Characteristic;
use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use App\Models\FeatureType;
use App\Models\Paper;
use App\Models\SubjectArea;
use App\Models\UrlFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContributeDatasetController extends Controller
{
    public function index()
    {
        $characteristics = Characteristic::all();
        $subjectAreas = SubjectArea::all();
        $associatedTasks = AssociatedTask::all();
        $featureTypes = FeatureType::all();
        $myDataset = Dataset::where('id_user', Auth::user()->id)
            ->where('status', 'pending')
            ->first();
        return view('donation', compact(['characteristics', 'subjectAreas', 'associatedTasks', 'featureTypes', 'myDataset']));
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
                'name.required' => 'Harap masukkan nama dataset Anda',
                'abstract.required' => 'Harap masukkan abstract dataset',
                'instances.required' => 'Harap masukkan jumlah baris dalam dataset',
                'features.required' => 'Harap masukkan jumlah fitur dalam dataset',
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

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'information' => ['required'],
                'files' => ['required'],
            ],
            [
                'information.required' => 'Harap masukkan informasi dataset',
                'files.required' => 'Harap masukkan file dataset Anda',
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
            $dataset = new Dataset();
            $dataset->id_user = Auth::user()->id;
            $dataset->id_subject_area = $request->subjectArea;
            $dataset->name = $request->name;
            $dataset->abstract = $request->abstract;
            $dataset->instances = $request->instances;
            $dataset->features = $request->features;
            $dataset->information = $request->information;
            $dataset->save();

            foreach ($request->file('files') as $file) {
                $urlFiles = new UrlFile();
                $urlFiles->id_dataset = $dataset->id;
                $path = $file->storeAs('public/datasets/' . $dataset->id, $file->getClientOriginalName());
                $urlFiles->url_file = str_replace('public/', '', $path);
                $urlFiles->save();
            }

            foreach (str_split($request->characteristics) as $characteristic) {
                if ($characteristic != ',') {
                    $newCharacteristic = new DatasetCharacteristic();
                    $newCharacteristic->id_dataset = $dataset->id;
                    $newCharacteristic->id_characteristic = $characteristic;
                    $newCharacteristic->save();
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

            foreach (str_split($request->featureTypes) as $featureType) {
                if ($featureType != ',') {
                    $newfeatureType = new DatasetFeatureType();
                    $newfeatureType->id_dataset = $dataset->id;
                    $newfeatureType->id_feature_type = $featureType;
                    $newfeatureType->save();
                }
            }

            if ($request->title) {
                if (!$request->url) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'Harap isi link paper'
                    ]);
                }
                $paper = new Paper();
                $paper->id_user = Auth::user()->id;
                $paper->id_dataset = $dataset->id;
                $paper->title = $request->title ?? '-';
                $paper->description = $request->description;
                $paper->url = $request->urlPaper;
                $paper->save();
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
                'message' => 'Terjadi kesalahan, silahkan coba lagi!',
            ]);
        }
    }

}
