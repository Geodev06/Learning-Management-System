<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function site_settings()
    {
        return view('pages.site_settings');
    }
    public function documentation()
    {
        return view('pages.documentation');
    }
}
