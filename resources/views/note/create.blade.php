<x-app-layout>
    <div class="note-container single-note">
        <h1 class="py-4 text-3xl">Create new note</h1>
        <form action="{{ route('note.store') }}" method="POST" class="note">
            @csrf
            <input type="text" name="name" class="note-name" placeholder="Enter note name">
            <textarea name="note" rows="10" class="note-body" placeholder="Enter your note here"></textarea>

            <div class="note-tags">
                <h2 class="py-4 text-2xl">Tags</h2>
                <select name="tags[]" multiple multiple class="select-tags">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
