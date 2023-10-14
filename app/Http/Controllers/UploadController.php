<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Services\FileUploadService;
use App\Models\Upload;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller
{

    public function index() {
        $uploads = Upload::all();
        return view("upload.index", ["uploads" => $uploads]);
    }

    public function store(UploadRequest $request, FileUploadService $fileUploadService) {
        $filename = $request->file->getClientOriginalName();

        if(!$filepath = $fileUploadService->upload($request->file, "uploads")) {
            return Redirect::back()->withErrors("File ".$filename." already exists.");
        }

        $upload = [
            "updated_by" => $request->user()->id,
            "file_path" => $filepath
        ];

        if(strpos($request->file->getClientMimeType(), "image/") === 0 ){
            $upload["thumb_path"] = $fileUploadService->generate_thumbnail($filepath, "uploads");
        }

        Upload::create($upload);

        return Redirect::to("/upload")->with("status", "File <a href='/$filepath'>$filename</a> successfully uploaded.");
    }

    public function destroy(Upload $upload) {
        $upload->delete();
        return Redirect::to("/upload")->with("status", "File $upload->file_path successfully deleted.");
    }

}
