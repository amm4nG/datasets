<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyDatasetController extends Controller
{
    public function index()
    {
        $datasets = Dataset::where('id_user', Auth::user()->id)->get();
        return view('my-dataset', compact('datasets'));
    }
}
