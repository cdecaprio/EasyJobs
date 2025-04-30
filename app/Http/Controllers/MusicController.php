<?php

namespace App\Http\Controllers;
use App\Models\Music;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(){
        $music = Music::all();
        return Inertia::render('Musicform', [
            'music' => $music,
        ]);
    }

    public function list(){
        $music = Music::all();
        return Inertia::render('Musiclist', [
            'music' => $music,
        ]);
    }

    public function save(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'song' => 'required|mimetypes:audio/mpeg,audio/mp3,audio/mpga,audio/m4a,audio/wav,audio/webm',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');
        $songPath = $request->file('song')->store('songs', 'public');
        $music = new Music();
        $music->title = $request->title;
        $music->artist = $request->artist;
        $music->song = $songPath;
        $music->image = $path;
        $music->user_id = auth()->user()->id;

       
        $music->save();
    }
}
