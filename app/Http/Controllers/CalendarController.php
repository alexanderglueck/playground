<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    public function __invoke()
    {
        return view('calendar.index');
    }
}
