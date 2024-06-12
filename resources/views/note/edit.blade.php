<x-app-layout>
    <div class="note-container single-note">
        <h1 class="py-4 text-3xl">Edit your note</h1>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            @csrf
            @method('PUT')
            <input type="text" name="name" class="note-name" placeholder="Enter note name" value="{{ $note->name }}">
            <textarea name="note" rows="10" class="note-body" placeholder="Enter your note here">{{ $note->note }}</textarea>
            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
