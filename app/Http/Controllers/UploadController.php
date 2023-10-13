<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller
{
    public function upload(UploadRequest $request, FileUploadService $fileUploadService) {
        $filename = $request->file->getClientOriginalName();
        if(!$filepath = $fileUploadService->upload($request->file, "uploads")) {
            return Redirect::back()->withErrors("File ".$filename." already exists.");
        }
        return view("upload", ["message"=>"File <a href='/$filepath'>$filename</a> successfully uploaded."]);
    }
}
