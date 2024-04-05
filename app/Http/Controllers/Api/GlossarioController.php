<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class GlossarioController extends Controller
{
    public function index()
    {

        $words = Word::with('tags', 'links')->paginate(5);

        return response()->json($words);
    }
}
