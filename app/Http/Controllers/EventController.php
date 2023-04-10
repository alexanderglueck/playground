<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Support\EventGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->get('start'); // 2023-03-26 00:00:00.0 +01:00
        $end = $request->get('end'); // 2023-05-07 00:00:00.0 +02:00

        $startUtc = Carbon::parse($start)->timezone('UTC');
        $endUtc = Carbon::parse($end)->timezone('UTC');

        return array_map(function (Event $event) {
            return $event->toFullCalendarEvent();
        }, EventGenerator::events($startUtc, $endUtc));
    }

    public function show()
    {
        \Auth::loginUsingId(User::first()->id);

        return view('calendar.index');
    }

    public function store()
    {
        $event = new Event();
        $event->name = 'Event 1';
        $event->starts_at = '2023-04-10 14:40:00';
        $event->ends_at = '2023-04-10 16:40:00';
        $event->save();

        $event = new Event();
        $event->name = 'Recurring event';
        $event->starts_at = '2023-04-11 14:40:00';
        $event->ends_at = '2023-04-11 16:40:00';
        $event->rrule = 'FREQ=DAILY;UNTIL=20240410T200000;BYDAY=MO,TU';
        $event->save();
    }
}
