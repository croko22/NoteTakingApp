<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = Tag::where("user_id", auth()->user()->id)->get();
        $search = $request->input('search');
        $tag = $request->input('tag');

        if ($tag) {
            $tag = Tag::findOrFail($tag);
            $notes = $tag->notes()
                ->where('user_id', request()->user()->id)
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('note', 'LIKE', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')->paginate()->appends(['search' => $search, 'tag' => $tag->id]);
        } else {
            $notes = Note::where('user_id', request()->user()->id)
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('note', 'LIKE', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')->paginate()->appends(['search' => $search]);
        }

        return view('note.index', ['notes' => $notes, 'tags' => $tags]);
    }

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->get('search');

    //     $notes = Note::where('name', 'like', "%{$searchTerm}%")
    //         ->orWhere('note', 'like', "%{$searchTerm}%")
    //         ->get();

    //     return view('note.index', compact('notes', 'searchTerm'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::where("user_id", auth()->user()->id)->get();
        return view('note.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string', 'max:255']
        ]);

        $data['user_id'] = auth()->user()->id;
        $note = Note::create($data);

        if ($request->tags) {
            $note->tags()->sync($request->tags);
        }

        return to_route('note.index', $note)->with('success', 'Note created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.edit', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $tags = Tag::where('user_id', auth()->user()->id)->get();
        return view('note.edit', ['note' => $note, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string', 'max:255']
        ]);

        $note->update($data);

        if ($request->tags) {
            $note->tags()->sync($request->tags);
        }

        return to_route('note.edit', $note)->with('success', 'Note was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $note->delete();

        return to_route('note.index')->with('success', 'Note was deleted');
    }
}
