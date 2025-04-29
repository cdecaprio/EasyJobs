<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Inertia\Inertia;
class OfferController extends Controller
{
    

    public function index()
    {
        $offers = Offer::all();
       
        return Inertia::render('Ofertalist', ['offers' => $offers]);
    }

    public function create(Request $request)
    {
        $offer = Offer::create($request->all());
        return redirect()->route('ofertalist');
    }
}
