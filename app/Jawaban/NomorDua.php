<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorDua {

    public function submit(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        Event::create([
            'name' => $validated['name'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('event.home')->with('success', 'Jadwal berhasil ditambahkan!');
    }
}

