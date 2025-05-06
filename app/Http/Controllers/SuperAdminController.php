<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display the super admin dashboard.
     */
    public function index()
    {
        return view('dashbord.layout.dashboard'); // Replace with your actual view file
    }
}
