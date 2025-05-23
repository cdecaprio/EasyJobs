<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use App\Models\Course;
use Inertia\Inertia;
class UsuariController extends Controller
{
    public function index()
    {
        $usuaris = Usuari::all();
        $courses = Course::all();
        return Inertia::render('Clase', [
            'usuaris' => $usuaris,
            'courses' => $courses,
        ]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);

        $usuari = new Usuari();
        $usuari->name = $request->name;
        $usuari->phone = $request->phone;
        $usuari->course_id = $request->course_id;
        $usuari->save();
        return redirect()->route('clase.index');
    }

    public function list()
    {
        $usuaris = Usuari::all();
        $courses = Course::all();
        
        return Inertia::render('Clase', [
            'usuaris' => $usuaris,
            'courses' => $courses,
            
        ]);
    }

    public function edit($id)
    {
        $usuari = Usuari::findOrFail($id);
        $courses = Course::all();
        return Inertia::render('editClase', [
            'usuari' => $usuari,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);
        $usuari = Usuari::find($id);
        $usuari->name = $request->name;
        $usuari->phone = $request->phone;
        $usuari->course_id = $request->course_id;
        $usuari->save();
        return response()->json($usuari);
    }

    public function delete($id)
    {
        $usuari = Usuari::find($id);
        $usuari->delete();
        return response()->json($usuari);
    }

    public function view()
    {
        $usuaris = Usuari::all();
        return response()->json($usuaris);
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');
    //     $usuaris = Usuari::where('name', 'like', "%$search%")->get();
    //     return response()->json($usuaris);
    // }
}
