<?php

namespace App\Http\Controllers;

use App\Models\LessonAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{


    public function upload(Request $request)
    {
        // Validate the file input if it's provide
        $lesson_id = base64_decode($request->lesson_id);

        if ($request->hasFile('file') && ($request->file_type == 'PDF' || $request->file_type == 'OTHER')) {
            // Custom validation rules for file
            $validated = $request->validate([
                'file' => 'required|mimes:jpg,png,pdf|max:10240', // Max 10MB, allowed types
            ]);

            // If file passes validation
            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Define the directory to store the file (in the public folder)
            $destinationPath = public_path('uploads'); // Store in public/uploads folder

            // Create the directory if it doesn't exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            $file_path = 'uploads/' . $fileName;

            try {
                DB::beginTransaction();

                LessonAttachment::create([
                    'lesson_id' => $lesson_id,
                    'file_type' => $request->file_type,
                    'file_path' => $file_path,
                    'file_system_name'=> $fileName,
                    'orig_file_name' => $file->getClientOriginalName(),
                ]);

                DB::commit();

            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error($th->getMessage());
            }

            return response()->json([
                'message' => 'File uploaded successfully!',
                'file_path' => url('uploads/' . $fileName),  // URL to access the file,
                'status' => 200
            ]);

           

        }

        // Validate the inputText if it's provided (only if file type is not PDF or OTHER)
        if ($request->has('inputText') && ($request->file_type != 'PDF' && $request->file_type != 'OTHER')) {
            // Validation for inputText if file type is not PDF or OTHER
            $validated = $request->validate([
                'inputText' => 'required|string', // Example: validating it as a string
            ]);

            $link = $request->input('inputText');

            try {

                DB::beginTransaction();

                LessonAttachment::create([
                    'lesson_id' => $lesson_id,
                    'file_type' => $request->file_type,
                    'file_path' => $link,
                ]);
                
                DB::commit();

            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error($th->getMessage());
            }

            // Process the link (e.g., store it, etc.)
            return response()->json([
                'message' => 'File uploaded successfully!',
                'file_path' => $link,  // URL to access the file,
                'status' => 200
            ]);
        }

        // If no file or text input provided
        return response()->json([
            'message' => 'No file or link provided.',
        ], 400);
    }
}
