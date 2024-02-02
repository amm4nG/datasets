<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageDatasetsController extends Controller
{
    public function index()
    {
        $datasets = Dataset::join('users', 'users.id', '=', 'datasets.id_user')
            ->select('datasets.id', 'name', 'full_name', 'status')
            ->get();
        return view('admin.manage-datasets', compact(['datasets']));
    }

    public function show($id)
    {
        $dataset = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->findOrFail($id);
        return view('admin.detail-dataset', compact(['dataset', 'id']));
    }

    public function valid($id)
    {
        $dataset = Dataset::findOrFail($id);
        $dataset->status = 'valid';
        $dataset->update();
        return response()->json([
            'message' => 'success',
        ]);
    }

    public function invalid(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        $dataset = Dataset::findOrFail($id);
        $dataset->status = 'invalid';
        $dataset->update();
        return response()->json([
            'status' => 200,
            'message' => 'invalid',
        ]);
    }
}
