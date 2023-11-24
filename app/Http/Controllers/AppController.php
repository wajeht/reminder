<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render('Index');
    }

    public function contact(Request $request): JsonResponse
    {
        return response()->json(['contact' => 'contact']);
    }

    public function terms(Request $request): JsonResponse
    {
        return response()->json(['message' => 'terms']);
    }

    public function privacy(Request $request): JsonResponse
    {
        return response()->json(['message' => 'privacy']);
    }

    public function healthz(Request $request): JsonResponse
    {
        return response()->json(['message' => 'ok']);
    }
}
