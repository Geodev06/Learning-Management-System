<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function user_management()
    {
        return view('pages.user_management');
    }

    public function get_specific_user(Request $request)
    {
        try {

            $user = User::find($request->id);
            $user->first_name = base64_decode($user->first_name);
            $user->middle_name = base64_decode($user->middle_name);
            $user->last_name = base64_decode($user->last_name);


            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json(NULL, 500);
        }
    }

    public function update_user(Request $request)
    {
        if (!empty($request->password)) {

            $validated = $request->validate([
                'password' => 'min:8'
            ]);

            User::find($request->id)->update([
                'password'      => Hash::make($request->password),
                'active_flag'   => $request->active_flag
            ]);

        } 
        
        else

        {
            User::find($request->id)->update([
                'active_flag'   => $request->active_flag
            ]);
        }

        return response()->json('Changes has been saved.', 200);
        
    }
}
