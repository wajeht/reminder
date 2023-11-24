<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AppController extends Controller
{
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render('Index');
    }

    public function contact(Request $request): InertiaResponse
    {
        return Inertia::render('Contact');
    }

    public function about(Request $request): InertiaResponse
    {
        return Inertia::render('About');
    }

    public function terms(Request $request): InertiaResponse
    {
        return Inertia::render('Terms');
    }

    public function privacy(Request $request): InertiaResponse
    {
        return Inertia::render('Privacy');
    }

    public function healthz(Request $request): JsonResponse
    {
        return response()->json(['message' => 'ok']);
    }
}
