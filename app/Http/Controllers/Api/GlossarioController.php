<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class GlossarioController extends Controller
{
    public function index(Request $request)
    {
        // Se arriva un filtro entro nell'IF
        if ($request->filter) {

            $words = Word::where('title', 'like', '%' . $request->filter . '%')->with('tags', 'links')->paginate(5);

            if ($words->isEmpty()) {
                // Return a response indicating no words found
                return response()->json(['message' => 'No words found.'], 404);
            }

            return response()->json($words);
        }

        $words = Word::with('tags', 'links')->paginate(5);

        return response()->json($words);
    }

    public function show(string $slug)
    {
        $word = Word::with('tags', 'links')->whereSlug($slug)->get();

        if (!$word) return response(null, 404);

        return response()->json($word);
    }
}
