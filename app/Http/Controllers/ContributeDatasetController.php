<?php

namespace App\Http\Controllers;

use App\Models\AssociatedTask;
use App\Models\Characteristic;
use App\Models\FeatureType;
use App\Models\SubjectArea;
use Illuminate\Http\Request;

class ContributeDatasetController extends Controller
{
    public function index()
    {
        $characteristics = Characteristic::all();
        $subjectAreas = SubjectArea::all();
        $associatedTasks = AssociatedTask::all();
        $featureTypes = FeatureType::all();
        return view('donation', compact(['characteristics', 'subjectAreas', 'associatedTasks', 'featureTypes']));
    }

    public function store(Request $request)
    {
        return response()->json([
            'formData' => $request->all(),
        ]);
    }
}
