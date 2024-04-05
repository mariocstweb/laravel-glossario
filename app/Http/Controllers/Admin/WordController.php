<?php

namespace App\Http\Controllers\Admin;


use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Link;
use App\Models\Tag;
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
    public function create(Word $word, Tag $tag)
    {
        $links = Link::select('title', 'id')->get();
        $tags = Tag::all();
        return view('admin.words.create', compact('word', 'links', 'tags'));
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

            foreach ($data['links'] as $link_id) {
                $link = Link::findOrFail($link_id);
                $link->word_id = $new_word->id;
                $link->save();
            }
        }

        if (Arr::exists($data, 'tags')) {
            $new_word->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.words.show', $new_word->id)
            ->with('Link', 'success')
            ->with('message', "$new_word->title caricato con successo.");
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
        $tags = Tag::all();
        $prev_links = $word->links->pluck('id')->toArray();
        $prev_tags = $word->tags->pluck('id')->toArray();
        return view('admin.words.edit', compact('word', 'links', 'prev_links', 'tags', 'prev_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        $data = $request->validated();
        $word->slug = $data['slug'];

        // Rimuovo la relazione tra parola i Link 
        Link::where('word_id', $word->id)->update(['word_id' => null]);

        // controllo la modifica ed aggiungo i link selezionati 
        if (Arr::exists($data, 'links')) {
            foreach ($data['links'] as $link_id) {
                $link = Link::findOrFail($link_id);
                $link->word_id = $word->id;
                $link->save();
            }
        }

        $word->update($data);

        if (Arr::exists($data, 'tags')) {
            $word->tags()->sync($data['tags']);
        } elseif (!Arr::exists($data, 'tags') && $word->has('tags')) {
            $word->tags()->detach();
        }

        return redirect()->route('admin.words.show', $word)
            ->with('Link', 'success')
            ->with('message', "$word->title modificato con successo.");
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

        if ($word->has('tags')) $word->tags()->detach();

        return to_route('admin.words.trash')
            ->with('type', 'danger')
            ->with('message', "Parola {$word->title} eliminata definitivamente");
    }
}
