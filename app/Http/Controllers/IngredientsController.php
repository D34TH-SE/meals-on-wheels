<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        logger($request->all());

        $validate = $request->validate([
            'ing_name' => 'required|string',
            'ing_type' => 'required|string',
            'unit' => 'required|string',
            'date_arrive' => 'required|date',
            'expiration_date' => 'required|date',
        ]);

        Ingredients::create([
            'ing_name' => $validate['ing_name'],
            'ing_type' => $validate['ing_type'],
            'unit' => $validate['unit'],
            'date_arrive' => $validate['date_arrive'],
            'expiration_date' => $validate['expiration_date'],
        ]);

        return redirect()->back()->with('Inggredients has been added');
    }

    public function update(Request $request, $id)
    {
        $ingredients = Ingredients::findOrFail($id);

        $validate = $request->validate([
            'ing_name' => 'required|string',
            'ing_type' => 'required|string',
            'unit' => 'required|string',
            'date_arrive' => 'required|date',
            'expiration_date' => 'required|date',
        ]);

        $ingredients->update([
            'ing_name' => $validate['ing_name'],
            'ing_type' => $validate['ing_type'],
            'unit' => $validate['unit'],
            'date_arrive' => $validate['date_arrive'],
            'expiration_date' => $validate['expiration_date'],
        ]);

        return redirect()->back()->with('success', 'Ingredients has been updated');
    }

    public function destroy(Ingredients $ingredients)
    {

        $ingredients->delete();

        return redirect(url('/admin/ingredients'))->with('success', 'Ingredients has been deleted');
    }
}
