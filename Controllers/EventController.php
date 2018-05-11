<?php

namespace vendorspace\Http\Controllers;

use Auth;
use Calendar;
use vendorspace\models\User;
use Illuminate\Http\Request;
use vendorspace\models\Event;

class EventController extends Controller
{
	public function getEventCreate()
	{
		return view('event.createevent');
	}

	public function getEventFinder()
	{
		return view('event.findevent');
	}

	public function getCalendar()
	{
	    $events = [];

	    $data = Event::all();

        if($data->count()){
            foreach ($data as $key => $value) {
            	if ($value->user_id === Auth::user()->id) {
	            	$events[] = Calendar::event(
		                $value->title, true,
	                	new \DateTime($value->start_date),
	                	new \DateTime($value->end_date.' +1 day')
	            	);
	            }
          	}
        }

        $calendar = Calendar::addEvents($events); 

		return view('event.calendar', compact('calendar'))
			->with('events', $events);
	}

	public function postCalendar(Request $request)
	{
		
		$this->validate($request, [
            'title' => 'required|max:255',
            'sdate' => 'required|date',
            'edate' => 'required|date', 
            'notes' => 'max:1000',   	
            ]);

		if (isset($_POST['add'])) {

	        $event = Event::create([
	        	'user_id' => Auth::user()->id,
	         	'title' => $request->input('title'),
	         	'start_date' => $request->input('sdate'),
	         	'end_date'   => $request->input('edate'),
	         	'notes' => $request->input('notes'),
	        ]);
	    }

        return redirect()->route('event.calendar')->with('info', 
            'Event added to calendar.');
	}
}