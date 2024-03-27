<?php

namespace App\Http\Controllers\Admin;


use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Word $word)
    {
        $words = Word::all();
        return view('admin.words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Word $word)
    {
        return view('admin.words.create', compact('word'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.words.show', compact('word'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        return view('admin.words.show', compact('word'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        return view('admin.words.edit', compact('word'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        return view('admin.words.show', compact('word'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return to_route('admin.words.index')
            ->with('type', 'danger')
            ->with('message', 'Hai spostato la parola nel cestino');;
    }

    public function trash()
    {
        $words = Word::onlyTrashed()->get();
        return view('admin.words.trash', compact('words'));
    }

    public function restore(Word $word)
    {
        $word->restore();
        return to_route('admin.words.index', $word->id)
            ->with('type', 'success')
            ->with('message', "Parola {$word->title} ripristinata con successo");
    }

    public function drop(Word $word)
    {
        $word->forceDelete();
        return to_route('admin.words.trash')
            ->with('type', 'danger')
            ->with('message', "Parola {$word->title} eliminata definitivamente");
    }
}
