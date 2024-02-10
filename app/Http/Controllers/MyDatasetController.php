<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use App\Models\Download;
use App\Models\Paper;
use App\Models\UrlFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MyDatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::where('id_user', Auth::user()->id)->get();
        return view('my-dataset', compact('datasets'));
    }

    public function show($id)
    {
        $dataset = Dataset::join('subject_areas', 'subject_areas.id', '=', 'datasets.id_subject_area')->find($id);
        $characteristics = DatasetCharacteristic::join('characteristics', 'characteristics.id', '=', 'dataset_characteristics.id_characteristic')->where('id_dataset', $id)->get();
        $featureTypes = DatasetFeatureType::join('feature_types', 'feature_types.id', '=', 'dataset_feature_types.id_feature_type')->where('id_dataset', $id)->get();
        $associatedTasks = DatasetAssociatedTask::join('associated_tasks', 'associated_tasks.id', '=', 'dataset_associated_tasks.id_associated_task')->where('id_dataset', $id)->get();
        $papers = Paper::where('id_dataset', $id)->get();
        return view('detail-my-dataset', compact(['dataset', 'characteristics', 'featureTypes', 'associatedTasks', 'papers']));
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
