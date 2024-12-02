<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $path = $file->store('ticket_videos', 'public'); // Almacena en el disco público
            $url = asset('storage/' . $path);
            return response()->json(['success' => true, 'url' => $url]);
        }

        return response()->json(['success' => false], 400);
    }
}
