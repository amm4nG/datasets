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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use League\Csv\Statement;

class ManageDatasetsController extends Controller
{
    public function index()
    {
        $datasets = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->select('datasets.id', 'name', 'full_name', 'status', 'note')->get();
        return view('admin.manage-datasets', compact(['datasets']));
    }

    public function show($id)
    {
        $dataset = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->findOrFail($id);
        $papers = Paper::where('id_dataset', $id)->get();

        $desiredRowCount = 6;

        // Lokasi folder tempat dataset disimpan
        $folderPath = 'public/datasets/' . $id;
        $files = Storage::files($folderPath);
        $data = [];

        foreach ($files as $file) {
            // Periksa apakah file memiliki ekstensi .csv
            if (pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
                $filePath = Storage::path($file);

                // Buat instance dari Reader
                $csv = Reader::createFromPath($filePath, 'r');
                $stmt = (new Statement())->offset(0)->limit($desiredRowCount);

                // Proses data CSV
                $records = $stmt->process($csv);

                // Baca header dari file CSV
                $headers = $csv->fetchOne();

                // Simpan data ke dalam array
                $data[] = [
                    'fileName' => basename($file),
                    'records' => $records,
                ];
            }
        }

        return view('admin.detail-dataset', compact(['dataset', 'papers', 'id', 'data', 'files']));
    }

    public function valid($id)
    {
        $dataset = Dataset::findOrFail($id);
        $dataset->status = 'valid';
        $dataset->note = '-';
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
        $dataset->note = $request->note;
        $dataset->update();
        return response()->json([
            'status' => 200,
            'message' => 'invalid',
        ]);
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
            $datasets = Dataset::join('users', 'users.id', '=', 'datasets.id_user')->select('datasets.id', 'name', 'full_name', 'status', 'note')->get();
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
