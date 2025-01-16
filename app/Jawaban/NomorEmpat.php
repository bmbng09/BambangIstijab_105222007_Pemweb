<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorEmpat {

    public function getJson() {
        $events = Event::all();
        $currentUserId = Auth::id();
        $data = $events->map(function ($event) use ($currentUserId) {
            return [
                'title' => $event->name . ' - ' . $event->user->name, // Nama jadwal + nama user
                'start' => $event->start, 
                'end'   => $event->end,
                'color' => $event->user_id === $currentUserId ? 'blue' : 'gray', // Warna
            ];
        });

        return response()->json($data);
    }
}

