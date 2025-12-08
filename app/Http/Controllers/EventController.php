<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::actifs()
                       ->avenir()
                       ->with('region')
                       ->latest('date_debut')
                       ->paginate(12);

        return view('pages.evenements.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('region');

        return view('pages.evenements.show', compact('event'));
    }
}