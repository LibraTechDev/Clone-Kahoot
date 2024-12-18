<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('auth.register', [
            'schools' => $schools
        ]);
    }
}