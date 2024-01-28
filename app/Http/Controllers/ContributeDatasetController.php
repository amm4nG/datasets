<?php

namespace App\Http\Controllers;

use App\Models\AssociatedTask;
use App\Models\Characteristic;
use App\Models\FeatureType;
use App\Models\SubjectArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function moreInfo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'abstract' => ['required', 'max:1000'],
                'instances' => ['required', 'numeric'],
                'features' => ['nullable', 'numeric'],
                'characteristics' => ['required'],
                'subjectArea' => ['required'],
                'associatedTasks' => ['required'],
                'featureTypes' => ['nullable'],
            ],
            [
                'name.required' => 'The dataset name field is required',
                'instances.required' => 'The number of instances field is required',
                'characteristics.required' => 'Select dataset characteristics',
                'subjectArea.required' => 'Please select subject area',
                'associatedTasks.required' => 'Please select associated task',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
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
                'information.required' => 'The dataset information field is required',
                'files' => 'The file dataset field is required',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        return response()->json([
            'data' => $request->all(),
        ]);
    }
}
