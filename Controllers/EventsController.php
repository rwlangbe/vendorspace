<?php

namespace vendorspace\Http\Controllers;

use Auth;
use Calendar;
use DateTime;
use vendorspace\models\Event;
use vendorspace\models\User;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function getCalendar()
    {
        $data = Event::where('state', "show")->get();
        if($data->count()){
            //foreach ($data as $key => $value) {

                //if ($value->id === Auth::user()->id) {
 
               // }
            //}
        }
        return $data;
    }

    public function index()
    {   
       // $events = Event::orderBy('created_at', 'desc')->get();
        $events = Event::where('state', "show")->get();
    	return $events;
    }

    public function store(Request $request) 
    {
        $event = Event::create($request->all());
    }

    public function deleteEvent ($id)
    {
        $event = Event::where([['id', '=' ,$id]])
            ->first()->update(['state' => 'deleted',]);
    }

    public function getEventById ($id)
    {
        return Event::where('id', $id)->first();
    }

    public function update (Request $request, $id)
    {
        $event = Event::find($id);
        $event->update($request->all());   
    }

    public function updateNewDate ($oldDate, $title, $newDate)
    {
        $event = Event::where([
            ['start_date', '=', $oldDate],
            ['title', '=', $title]
        ])->first();

        $oldStart = new DateTime($oldDate);
        $end = new DateTime($event->end_date);
        $span= $oldStart->diff($end);

        $newStart = new DateTime($newDate);
        $newEnd = new DateTime($newDate);
        $newEnd = $newEnd->add($span);

        $event = Event::where([
            ['start_date', '=', $oldDate],
            ['title', '=', $title]
        ])->update([
            'start_date' => $newStart,
            'end_date' => $newEnd,
        ]);

        $data = Event::where('state', "show")->get();
        if($data->count()){
            //foreach ($data as $key => $value) {

                //if ($value->id === Auth::user()->id) {
 
               // }
            //}
        }
        return $data;
    }
}
