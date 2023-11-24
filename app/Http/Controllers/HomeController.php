<?php

namespace App\Http\Controllers;

use Inertia\Response as InertiaResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render('Home');
    }
}
