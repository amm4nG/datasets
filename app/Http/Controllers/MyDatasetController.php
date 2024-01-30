<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $characteristics = DatasetCharacteristic::join('characteristics', 'characteristics.id', '=', 'dataset_characteristics.id_characteristic')
            ->where('id_dataset', $id)
            ->get();
        $featureTypes = DatasetFeatureType::join('feature_types', 'feature_types.id', '=', 'dataset_feature_types.id_feature_type')
            ->where('id_dataset', $id)
            ->get();
        $associatedTasks = DatasetAssociatedTask::join('associated_tasks', 'associated_tasks.id', '=', 'dataset_associated_tasks.id_associated_task')
            ->where('id_dataset', $id)
            ->get();
        return view('detail-my-dataset', compact(['dataset', 'characteristics', 'featureTypes', 'associatedTasks']));
    }
}
