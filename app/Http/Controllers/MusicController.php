<?php

namespace App\Http\Controllers;
use App\Models\Music;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(){
        $music = Music::all();
        return Inertia::render('Musiclist', [
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
        return redirect()->route('musiclist.list');
    }

    public function random()
    {
        $music = Music::inRandomOrder()->first();
        return response()->json($music);
    }

    public function delete($id){
        $music = Music::find($id);
        $music->delete();
        
        return response()->json($music);
    }

    //para ver los nuevos datos de la cancion (axios)
    public function view(){
        $music = Music::all();
        return response()->json($music);
    }

    public function edit($id){
        $music = Music::find($id);
        return Inertia::render('Musicedit', [
            'music' => $music,
        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'song' => 'nullable|mimetypes:audio/mpeg,audio/mp3,audio/mpga,audio/m4a,audio/wav,audio/webm',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $music = Music::findOrFail($id);
        $music->title = $request->title;
        $music->artist = $request->artist;

        // Actualizar imagen si se proporciona una nueva
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($music->image && Storage::disk('public')->exists($music->image)) {
                Storage::disk('public')->delete($music->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $music->image = $path;
        }

        // Actualizar canción si se proporciona una nueva
        if ($request->hasFile('song')) {
            // Eliminar la canción anterior si existe
            if ($music->song && Storage::disk('public')->exists($music->song)) {
                Storage::disk('public')->delete($music->song);
            }
            $songPath = $request->file('song')->store('songs', 'public');
            $music->song = $songPath;
        }
        
        $music->save();
        return redirect()->route('musiclist.list');
    }

}
