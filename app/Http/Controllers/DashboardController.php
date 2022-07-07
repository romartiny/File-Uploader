<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        $req->file('file')->store('files');
        $this->uploadLog($req);
        $this->showFileNames();

        return redirect('dashboard');
    }

    public function uploadLog(Request $req)
    {
        $size = Storage::size($req->file('file')->store('files'));
        $name = File::name($req->file('file')->store('files'));
        $date = date('Y-m-d H:i:s');
        $dateFile = date('d-m-Y');
        Storage::disk('local')->append("logs/logs-$dateFile.log", "$size bytes | $name | $date");
    }

    public function createFolder()
    {
        $path = public_path('../storage/app/files');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    public function getExifData($req)
    {
        return Image::make(public_path("../storage/app/files/$reg"))->exif();
    }

    public function showFileNames()
    {
        $this->createFolder();
//        $this->getExifData();
        $path = public_path('../storage/app/files');
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $fileNames[] = pathinfo($file)['filename'];
        }

        if (empty($fileNames)) {
            return view('upload');
        } else {
            return view('upload', ['fileNames' => $fileNames]);
        }
    }
}
