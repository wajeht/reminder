<?php

namespace App\Http\Controllers;

use Inertia\Response as InertiaResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render('Calendar', [
            'events' => request()->user()->load('events')->events,
        ]);
    }
}
