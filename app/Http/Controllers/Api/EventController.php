<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    public function events()
    {
        return response()->json(Event::all());
    }

    public function activeEvents()
    {
        $date = date('Y-m-d h:i:s');

        $events = Event::where('startAt', '<=', Carbon::now())->where('endAt', '>', Carbon::now())->get();

        return response()->json($events);
    }

    public function event(Event $event)
    {
        return response()->json($event);
    }

    public function store(StoreEventRequest $request)
    {
        try {
            Event::create($request->post());
        } catch (Throwable $e) {
            report($e);
     
            return $e;
        }
    }

    public function update(UpdateEventRequest $request, $id)
    {
        if (Event::where('id', $id)->exists()) {
            try {
                $event = Event::where('id', $id)->first();
                $event->fill($request->post())->save();
            } catch (Throwable $e) {
                report($e);
         
                return $e;
            }
        } else {
            try {
                Event::create($request->post());
            } catch (Throwable $e) {
                report($e);
         
                return $e;
            }
        }
    }

    public function patch(UpdateEventRequest $request, Event $event)
    {
        try {
            $event->fill($request->post())->save();

            return 'Successfully Updated';
        } catch (Throwable $e) {
            report($e);
     
            return $e;
        }
    }

    public function destroy(Event $event)
    {
        return $event->delete();
    }
}
