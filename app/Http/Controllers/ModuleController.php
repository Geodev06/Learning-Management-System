<?php

namespace App\Http\Controllers;

use App\Models\ModuleDetail;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function save_module_access($module_id, Request $request)
    {
        // Ensure selected_values is present and not empty
        if (!empty($request->selected_values)) {

            // Clear existing module details
            ModuleDetail::where('module_id', $module_id)->delete();

            // Insert new module details for each selected value
            foreach ($request->selected_values as $item) {
                // Ensure $item is valid (e.g., a string or valid code, if necessary)
                if (is_string($item) && !empty($item)) {
                    ModuleDetail::create([
                        'org_code' => $item,
                        'module_id' => $module_id,
                    ]);
                }
            }

            // Return success message after saving
            return response()->json('Saved.', 200);
        }

        ModuleDetail::where('module_id', $module_id)->delete();

        // If no selected_values were provided, return a 404 response
        return response()->json('Nothing saved.', 200);
    }
}
