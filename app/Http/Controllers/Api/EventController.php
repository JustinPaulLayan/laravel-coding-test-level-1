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
            Event::create([
                'name' => $request->input('name'),
                'startAt' => $request->input('startAt'),
                'endAt' => $request->input('endAt'),
            ]);
        } catch (Throwable $e) {
            report($e);
     
            return $e;
        }
    }

    public function update(UpdateEventRequest $request, $id)
    {
        if (Event::where('id', $id)->exists()) {
            try {
                Event::where('id', $id)->update([
                    'name' => $request->input('name'),
                    'startAt' => $request->input('startAt'),
                    'endAt' => $request->input('endAt'),
                ]);
            } catch (Throwable $e) {
                report($e);
         
                return $e;
            }
        } else {
            try {
                Event::create([
                    'name' => $request->input('name'),
                    'startAt' => $request->input('startAt'),
                    'endAt' => $request->input('endAt'),
                ]);
            } catch (Throwable $e) {
                report($e);
         
                return $e;
            }
        }
    }

    public function patch(UpdateEventRequest $request, Event $event)
    {
        try {
            $event->update([
                'name' => $request->input('name'),
                'startAt' => $request->input('startAt'),
                'endAt' => $request->input('endAt'),
            ]);

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
