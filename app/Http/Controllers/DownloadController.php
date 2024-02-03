<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadController extends Controller
{
    public function download($id)
    {
        $dataset = Dataset::findOrFail($id);
        $path = $id;

        $files = Storage::files('public/datasets/' . $path);
 
        $zip = new ZipArchive();
        $zipFileName = $dataset->name . '.zip';

        if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === true) {
            // Tambahkan setiap file ke dalam zip
            foreach ($files as $file) {
                // Ambil nama file dari path lengkap
                $fileName = pathinfo($file, PATHINFO_BASENAME);
                // Tambahkan file ke dalam zip dengan nama yang sama
                $zip->addFile(storage_path('app/' . $file), $fileName);
            }

            // Tutup zip setelah semua file ditambahkan
            $zip->close();

            // Kirimkan file zip sebagai tanggapan (response)
            return response()
                ->download(storage_path($zipFileName))
                ->deleteFileAfterSend(true);
        } else {
            // Jika terjadi kesalahan saat membuat zip
            return response()->json(['error' => 'Gagal membuat file zip'], 500);
        }
    }
}
