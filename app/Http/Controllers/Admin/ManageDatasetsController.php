<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use Illuminate\Http\Request;

class ManageDatasetsController extends Controller
{
    public function index(){
        $datasets = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->select('datasets.id', 'name', 'full_name', 'status')->get();
        return view('admin.manage-datasets', compact(['datasets']));
    }

    public function show($id){
        $dataset = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->findOrFail($id);
        return view('admin.detail-dataset', compact(['dataset']));
    }
}
