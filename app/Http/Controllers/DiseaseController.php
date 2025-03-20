<?php

namespace App\Http\Controllers;
use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'disease_name' => 'required|string|max:255',
            'disease_description' => 'required|string',
            'remedies' => 'required|string',
            'weather' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image validation
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('diseases', 'public'); // Store in storage/app/public/diseases
        }

        // Create Disease entry
        $disease = Disease::create([
            'disease_name' => $request->disease_name,
            'disease_description' => $request->disease_description,
            'remedies' => $request->remedies,
            'weather' => $request->weather,
            'image' => $imagePath
        ]);

        return response()->json([
            'message' => 'Disease created successfully',
            'data' => $disease
        ], 201);
    }
}

