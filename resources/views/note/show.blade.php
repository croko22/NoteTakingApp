<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="py-4 text-3xl">{{ $note->name }}</h1>
            <div class="note-buttons">
                <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                <form action="{{ route('note.destroy', $note) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">Delete</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">
                {{ $note->note }}
            </div>
        </div>
        <div class="note-tags">
            <h2 class="py-4 text-2xl">Tags</h2>
            @foreach ($note->tags as $tag)
                <span class="tag">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
</x-app-layout>
