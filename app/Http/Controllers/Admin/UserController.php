<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DatasetAssociatedTask;
use App\Models\DatasetCharacteristic;
use App\Models\DatasetFeatureType;
use App\Models\Download;
use App\Models\Paper;
use App\Models\UrlFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.manage-users', compact('users'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $datasets = Dataset::where('id_user', $id)->get();
            foreach ($datasets as $dataset) {
                $dataset = Dataset::findOrFail($dataset->id);
                $dataset->delete();

                $characteristics = DatasetCharacteristic::where('id_dataset', $dataset->id)->get();
                foreach ($characteristics as $characteristic) {
                    $characteristic->delete();
                }

                $associatedTasks = DatasetAssociatedTask::where('id_dataset', $dataset->id)->get();
                foreach ($associatedTasks as $associatedTask) {
                    $associatedTask->delete();
                }

                $featureTypes = DatasetFeatureType::where('id_dataset', $dataset->id)->get();
                foreach ($featureTypes as $featureType) {
                    $featureType->delete();
                }

                $downloads = Download::where('id_dataset', $dataset->id)->get();
                foreach ($downloads as $download) {
                    $download->delete();
                }

                $papers = Paper::where('id_dataset', $dataset->id)->get();
                foreach ($papers as $paper) {
                    $paper->delete();
                }

                $urlFiles = UrlFile::where('id_dataset', $dataset->id)->get();
                foreach ($urlFiles as $urlFile) {
                    Storage::delete('public/' . $urlFile->url_file);
                    $urlFile->delete();
                }
            }
            $user->delete();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }

        return response()->json([
            'message' => 'success',
        ]);
    }
}
