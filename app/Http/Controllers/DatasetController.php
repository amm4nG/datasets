<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use App\Models\Paper;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::where('status', 'valid')->get();
        return view('datasets', compact('datasets'));
    }

    public function show($id)
    {
        $dataset = Dataset::join('subject_areas', 'subject_areas.id', '=', 'datasets.id_subject_area')->join('users', 'users.id', '=', 'datasets.id_user')->find($id);
        $characteristics = DatasetCharacteristic::join('characteristics', 'characteristics.id', '=', 'dataset_characteristics.id_characteristic')
            ->where('id_dataset', $id)
            ->get();
        $featureTypes = DatasetFeatureType::join('feature_types', 'feature_types.id', '=', 'dataset_feature_types.id_feature_type')
            ->where('id_dataset', $id)
            ->get();
        $associatedTasks = DatasetAssociatedTask::join('associated_tasks', 'associated_tasks.id', '=', 'dataset_associated_tasks.id_associated_task')
            ->where('id_dataset', $id)
            ->get();
        $papers = Paper::where('id_dataset', $id)->get();
        return view('detail', compact(['dataset', 'characteristics', 'featureTypes', 'associatedTasks', 'papers']));
    }
}
