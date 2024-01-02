<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    //
    public function myFile()
    {
        return  Inertia::render('MyFiles');
    }
}
