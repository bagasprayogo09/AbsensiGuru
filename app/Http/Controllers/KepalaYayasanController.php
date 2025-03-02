<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalaYayasanController extends Controller
{
    public function index()
    {
        return view('kepala_yayasan.dashboard');
    }
}
