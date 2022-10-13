<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Carbon\Carbon;
use App\Models\Event;
use App\Events\EventCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Event as EventFacade;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function events()
    {
        EventFacade::dispatch(new EventCreated());

        $events = cache('events', function () {
            return Event::get();
        });

        return response()->json([
            "success" => true,
            "message" => "Event List",
            "data" => $events
        ]);
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

            return;
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

                return;
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
