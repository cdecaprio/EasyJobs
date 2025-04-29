<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Offer;
use Inertia\Inertia;
class OfferController extends Controller
{
    

    public function index()
    {
        $offers = Offer::all();
        
        return Inertia::render('Ofertalist', [
            'offers' => $offers,
        ]);
    }

   

    public function save(Request $request){
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'age' => 'required|numeric',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
//php artisan storage:link
//mkdir -p storage/app/public/images
        // Generar un nombre único para la imagen
        $path = $request->file('image')->store('images', 'public');
       
        $offer = new Offer();
        $offer->title = $validated['title'];
        $offer->description = $validated['description'];
        $offer->salary = $validated['salary'];
        $offer->image = $path;
        $offer->age = $validated['age'];
        $offer->category = $validated['category'];
        $offer->status = $validated['status'];
        $offer->user_id = auth()->user()->id;

        

       
        $offer->save();
        
        return redirect()->route('ofertalist.index');
    }

   
}
