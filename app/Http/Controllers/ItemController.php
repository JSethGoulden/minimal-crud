<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.index', ['items' => Item::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $item = Item::create([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return redirect()->route('items.show', $item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view ('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required'
        ]);

        $item->name = $validated['name'];
        $item->description = $validated['description'];

        $item->save();

        return redirect()->route('items.show', $item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
