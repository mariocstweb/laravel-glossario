<?php

namespace App\Http\Controllers\Admin;


use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Stringable;

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
        $links = Link::select('title', 'id')->get();
        return view('admin.words.create', compact('word', 'links'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        $data = $request->validated();

        $new_word = new Word();

        $new_word->fill($data);

        $new_word->slug = Str::slug($new_word->title);

        $new_word->save();

        if (Arr::exists($data, 'links')) {
            $new_word->links()->attach($data['links']);
        }

        return redirect()->route('admin.words.show', $new_word->id);
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
        $links = Link::select('title', 'id')->get();
        return view('admin.words.edit', compact('word', 'links'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        return view('admin.words.show', compact('word'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return to_route('admin.words.index');
    }
}
