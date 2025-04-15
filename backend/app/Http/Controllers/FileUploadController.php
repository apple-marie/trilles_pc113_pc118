<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;;

class FileUploadController extends Controller
{  
    public function index()
    {
        return response()->json(FileUpload::all());
    }

    
    public function fileUpload(Request $request)
    {
        try{
            $request->validate([
                'path' => 'required|mimes:pdf,doc,docx|max:10240',
                'name' => 'required',
            ]);
    
            $file = $request->file('path');
            $path = $file->store('uploads', 'public');
            $save = FileUpload::create([
                'name' => $request->name,
                'path' => $path
            ]);
            
            return response()->json([
                'message' => 'File uploaded successfully',
                
            ]);
        }catch(ValidationException $e) {
            return response()->json([

            ]);
        }
    }
}
