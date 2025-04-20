<?php

namespace App\Http\Controllers;

use App\Models\LessonAttachment;
use App\Models\Module;
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


        $file_type = $request->file_type;

        switch ($file_type) {

            case 'PDF':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|max:255|string',
                        'file' => 'required|array',
                        'file.*' => 'file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,mp4,mov,avi', // Adjust types as needed
                    ]);

                    // Check if files are uploaded
                    if ($request->hasFile('file')) {
                        $uploadedFiles = $request->file('file');
                        $savedFiles = [];

                        foreach ($uploadedFiles as $file) {
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $destinationPath = public_path('uploads');

                            if (!File::exists($destinationPath)) {
                                File::makeDirectory($destinationPath, 0755, true);
                            }

                            $file->move($destinationPath, $fileName);
                            $file_path = 'uploads/' . $fileName;

                            try {
                                DB::beginTransaction();

                                $attachment = LessonAttachment::create([
                                    'lesson_id' => $lesson_id,
                                    'file_type' => $request->file_type,
                                    'file_path' => $file_path,
                                    'caption' => $request->caption,
                                    'file_system_name' => $fileName,
                                    'orig_file_name' => $file->getClientOriginalName(),
                                ]);

                                DB::commit();

                                $savedFiles[] = [
                                    'id' => $attachment->id,
                                    'file_path' => url($file_path),
                                    'original_name' => $file->getClientOriginalName(),
                                ];
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                Log::error($th->getMessage());
                            }
                        }

                        return response()->json([
                            'message' => 'Files uploaded successfully!',
                            'files' => $savedFiles,
                            'status' => 200,
                        ]);
                    }

                    return response()->json([
                        'message' => 'No files provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }

                break;
            case 'AUDIO':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|string',
                        'file' => 'required', // Max 5mb, allowed types
                    ]);

                    // If validation passes, check if file is uploaded
                    if ($request->has('file')) {
                        $file = $request->file('file');
                        $fileName = time() . '-' . $file->getClientOriginalName();

                        // Define the directory to store the file (in the public folder)
                        $destinationPath = public_path('uploads'); // Store in public/uploads folder

                        // Create the directory if it doesn't exist
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true);
                        }

                        // Move the file to the destination directory
                        $file->move($destinationPath, $fileName);

                        $file_path = 'uploads/' . $fileName;

                        try {
                            DB::beginTransaction();

                            LessonAttachment::create([
                                'lesson_id' => $lesson_id,
                                'file_type' => $request->file_type,
                                'file_path' => $file_path,
                                'caption' => $request->caption,
                                'file_system_name' => $fileName,
                                'orig_file_name' => $file->getClientOriginalName(),
                            ]);

                            DB::commit();
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            Log::error($th->getMessage());
                        }

                        return response()->json([
                            'message' => 'File uploaded successfully!',
                            'file_path' => url('uploads/' . $fileName),  // URL to access the file
                            'status' => 200
                        ]);
                    }

                    return response()->json([
                        'message' => 'No file or link provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Catch validation exceptions and return the errors as JSON
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }
                break;
            case 'IMAGES':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|max:255|string',
                        'file' => 'required', // Max 5mb, allowed types
                    ]);
                    // If validation passes, check if file is uploaded
                    if ($request->has('file')) {
                        $file = $request->file('file');
                        $fileName = time() . '-' . $file->getClientOriginalName();

                        // Define the directory to store the file (in the public folder)
                        $destinationPath = public_path('uploads'); // Store in public/uploads folder

                        // Create the directory if it doesn't exist
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true);
                        }

                        // Move the file to the destination directory
                        $file->move($destinationPath, $fileName);

                        $file_path = 'uploads/' . $fileName;

                        try {
                            DB::beginTransaction();

                            LessonAttachment::create([
                                'lesson_id' => $lesson_id,
                                'file_type' => $request->file_type,
                                'file_path' => $file_path,
                                'caption' => $request->caption,
                                'file_system_name' => $fileName,
                                'orig_file_name' => $file->getClientOriginalName(),
                            ]);

                            DB::commit();
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            Log::error($th->getMessage());
                        }

                        return response()->json([
                            'message' => 'File uploaded successfully!',
                            'file_path' => url('uploads/' . $fileName),  // URL to access the file
                            'status' => 200
                        ]);
                    }

                    return response()->json([
                        'message' => 'No file or link provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Catch validation exceptions and return the errors as JSON
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }
                break;

            case 'LINK':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|max:255|string',
                        'inputText' => 'required|string|max:1000', // Max 5mb, allowed types
                    ]);

                    try {
                        DB::beginTransaction();

                        LessonAttachment::create([
                            'lesson_id' => $lesson_id,
                            'file_type' => $request->file_type,
                            'file_path' => $request->inputText,
                            'caption' => $request->caption,
                            'file_system_name' => 'Link',
                            'orig_file_name' => $request->inputText,
                        ]);

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        Log::error($th->getMessage());
                    }

                    return response()->json([
                        'message' => 'File uploaded successfully!',
                        'file_path' => url('uploads/' . $request->inputText),  // URL to access the file
                        'status' => 200
                    ]);

                    return response()->json([
                        'message' => 'No file or link provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Catch validation exceptions and return the errors as JSON
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }
                break;

            case 'PPT':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|max:255|string',
                        'inputText' => 'required|string', // Max 5mb, allowed types
                    ]);

                    try {
                        DB::beginTransaction();

                        LessonAttachment::create([
                            'lesson_id' => $lesson_id,
                            'file_type' => $request->file_type,
                            'file_path' => $request->inputText,
                            'caption' => $request->caption,
                            'file_system_name' => 'Link',
                            'orig_file_name' => $request->inputText,
                        ]);

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        Log::error($th->getMessage());
                    }

                    return response()->json([
                        'message' => 'File uploaded successfully!',
                        'file_path' => url('uploads/' . $request->inputText),  // URL to access the file
                        'status' => 200
                    ]);

                    return response()->json([
                        'message' => 'No file or link provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Catch validation exceptions and return the errors as JSON
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }
                break;

            case 'VIDEO':
                try {
                    // Perform validation
                    $validated = $request->validate([
                        'caption' => 'required|string',
                        'file' => 'required|array',
                        'file.*' => 'file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,video/webm,video/x-flv|max:51200', // 50MB per file
                    ]);

                    // If validation passes, check if files are uploaded
                    if ($request->hasFile('file')) {
                        $uploadedFiles = $request->file('file');
                        $savedFiles = [];

                        foreach ($uploadedFiles as $file) {
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $destinationPath = public_path('uploads');

                            if (!File::exists($destinationPath)) {
                                File::makeDirectory($destinationPath, 0755, true);
                            }

                            $file->move($destinationPath, $fileName);
                            $file_path = 'uploads/' . $fileName;

                            try {
                                DB::beginTransaction();

                                $attachment = LessonAttachment::create([
                                    'lesson_id' => $lesson_id,
                                    'file_type' => $request->file_type,
                                    'file_path' => $file_path,
                                    'caption' => $request->caption,
                                    'file_system_name' => $fileName,
                                    'orig_file_name' => $file->getClientOriginalName(),
                                ]);

                                DB::commit();

                                $savedFiles[] = [
                                    'id' => $attachment->id,
                                    'file_path' => url($file_path),
                                    'original_name' => $file->getClientOriginalName(),
                                ];
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                Log::error($th->getMessage());
                            }
                        }

                        return response()->json([
                            'message' => 'Videos uploaded successfully!',
                            'files' => $savedFiles,
                            'status' => 200,
                        ]);
                    }

                    return response()->json([
                        'message' => 'No video files provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }

                break;

            case 'OTHER':
                try {
                    // Perform validation
                    $request->validate([
                        'file' => 'required|file|mimes:zip,rar,tar,tgz,gz,7z',
                    ], [
                        'file.required' => 'A compressed file is required.',
                        'file.file' => 'The uploaded item must be a valid file.',
                        'file.mimes' => 'Only compressed file types (zip, rar, tar, tgz, gz, 7z) are allowed.',
                        // 'file.max' => 'The file size must not exceed 10MB.',
                    ]);


                    // If validation passes, check if file is uploaded
                    if ($request->has('file')) {
                        $file = $request->file('file');
                        $fileName = time() . '-' . $file->getClientOriginalName();

                        // Define the directory to store the file (in the public folder)
                        $destinationPath = public_path('uploads'); // Store in public/uploads folder

                        // Create the directory if it doesn't exist
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true);
                        }

                        // Move the file to the destination directory
                        $file->move($destinationPath, $fileName);

                        $file_path = 'uploads/' . $fileName;

                        try {
                            DB::beginTransaction();

                            LessonAttachment::create([
                                'lesson_id' => $lesson_id,
                                'file_type' => $request->file_type,
                                'file_path' => $file_path,
                                'caption' => $request->caption,
                                'file_system_name' => $fileName,
                                'orig_file_name' => $file->getClientOriginalName(),
                            ]);

                            DB::commit();
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            Log::error($th->getMessage());
                        }

                        return response()->json([
                            'message' => 'File uploaded successfully!',
                            'file_path' => url('uploads/' . $fileName),  // URL to access the file
                            'status' => 200
                        ]);
                    }

                    return response()->json([
                        'message' => 'No file or link provided.',
                    ], 400);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Catch validation exceptions and return the errors as JSON
                    return response()->json([
                        'message' => 'Validation failed',
                        'errors' => $e->errors(),
                    ], 422);
                }
                break;


            default:
                return response()->json([
                    'message' => 'Need to setup this module. please contact system administrator.',
                ], 400);
                break;
        }
    }

    public function profile_upload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif|max:2048', // Adjust the mime types and max size as needed
        ]);

        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Define the file name and save it in the 'public' folder
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/profile_images/' . $fileName; // Define your folder path in 'public'

            // Move the file to the 'public' folder (public/storage folder)
            $file->move(public_path('uploads/profile_images'), $fileName);

            // Optionally, save the file path in the database
            $user = auth()->user(); // Assuming the user is authenticated
            $user->profile = $filePath; // Save the file path in the profile_image column
            $user->save();

            return response()->json([
                'success' => true,
                'file_path' => $filePath
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded'
        ]);
    }

    public function module_bg_upload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif|max:2048', // Adjust the mime types and max size as needed
        ]);

        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Define the file name and save it in the 'public' folder
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/module_bg/' . $fileName; // Define your folder path in 'public'

            // Move the file to the 'public' folder (public/storage folder)
            $file->move(public_path('uploads/module_bg'), $fileName);


            Module::find($request->module_id)->update([
                'bg_image' => $filePath
            ]);

            return response()->json([
                'success' => true,
                'file_path' =>  $filePath
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded'
        ]);
    }

    public function download($filename)
    {
        $filePath = public_path('files/' . $filename);

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->download($filePath); // Return the file for download
        } else {
            abort(404); // Return a 404 error if the file doesn't exist
        }
    }
}
