<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga {

    public function getData() {
        $data = Event::all(); 
        return $data;
    }


    public function getSelectedData(Request $request) {
        $id = $request->query('id');
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Data tidak ditemukan!'], 404);
        }

        return response()->json($event);
    }


    public function update(Request $request) {
        $eventId = $request->input('id');
        $event = Event::find($eventId);

        if ($event) {
            // Update data event
            $event->name = $request->input('name');
            $event->start = $request->input('start');
            $event->end = $request->input('end');
            $event->save();

            return response()->json(['message' => 'Jadwal berhasil diperbarui!'], 200);
        }

        return response()->json(['message' => 'Jadwal tidak ditemukan!'], 404);
    }


    public function delete(Request $request) {
        $eventId = $request->input('id');
        Event::where('id', $eventId)->delete();

        return redirect()->route('event.home');
    }

}

?>
