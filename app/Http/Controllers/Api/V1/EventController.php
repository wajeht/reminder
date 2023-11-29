<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): JsonResponse
    {
        $this->authorize('view');

        return response()->json([
            'message' => 'ok',
            'data' => $request->user()->events()->get(),
        ]);
    }

    public function show(Request $request, Event $event): JsonResponse
    {
        $this->authorize('view', $event);

        return response()->json([
            'message' => 'ok',
            'data' => [$event],
        ]);
    }

    public function destroy(Request $request, Event $event): JsonResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json([
            'message' => 'ok',
            'data' => [$event],
        ]);
    }
}
