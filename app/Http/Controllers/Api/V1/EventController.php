<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'ok',
            'data' => Event::all(),
        ]);
    }

    public function destroy(Request $request, Event $event): JsonResponse
    {
        $event->delete();

        return response()->json([
            'message' => 'ok',
            'data' => $event,
        ]);
    }
}
