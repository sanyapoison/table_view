<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->bathrooms);
        }
        if ($request->filled('storeys')) {
            $query->where('storeys', $request->storeys);
        }
        if ($request->filled('garages')) {
            $query->where('garages', $request->garages);
        }
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        return response()->json($query->get());
    }
}
