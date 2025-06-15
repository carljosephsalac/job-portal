<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobPortalController extends Controller
{
    public function index()
    {
        return view('job-portals.index');
    }
}
