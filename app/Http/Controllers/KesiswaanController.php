<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public function index()
    {
        return view('kesiswaan.dashboardkesiswaan', [
            "title" => "Dashboard",
        ]);
    }
}
