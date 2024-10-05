<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonationPaperController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors(),
            ]);
        }

        $paper = new Paper();
        $paper->id_user = Auth::user()->id;
        $paper->id_dataset = $request->id_dataset;
        $paper->title = $request->title;
        $paper->url = $request->url;
        $paper->description = $request->description;
        $paper->save();

        return response()->json([
            'status' => 200,
            'message' => 'You have contributed a paper to this dataset.',
        ]);
    }
}
