<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class CalendarController extends Controller
{
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render('Calendar', [
            'events' => request()->user()->load('events')->events->map(function (Event $event) {
                return [
                    ...$event->toArray(),
                    'date' => $event->start_date,
                ];
            }),
        ]);
    }
}
