<?php

namespace App\Http\Controllers;

use App\Models\StudentModule;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.profile');
    }

    public function profile_preview($id)
    {
        $user_id = decrypt($id);
        $user = User::find($user_id);

        $user_modules = StudentModule::with('modules')->where('created_by', $user->id)->paginate(5);
        return view('pages.profile_preview', compact('user','user_modules'));
    }
}
