<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Analyse;

class AIController extends Controller
{
    public function index()
    {
        return view('ai');
    }
}

