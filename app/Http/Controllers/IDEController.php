<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IDEController extends Controller
{
    public function index($ide)
    {
        $ide = decrypt($ide);

        switch ($ide) {
            case 'python':
                $view = 'ide.python';
                break;
            case 'c#':
                $view = 'ide.c#';
                break;
            case 'js':
                $view = 'ide.js';
                break;
            case 'java':
                $view = 'ide.java';
                break;
            case 'php':
                $view = 'ide.php';
                break;
            case 'sqlite':
                $view = 'ide.sqlite';
                break;
        }
        return view($view);
    }
}
