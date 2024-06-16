<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="py-4 text-3xl">{{ $note->name }}</h1>
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <div class="note-buttons">
                <form action="{{ route('note.destroy', $note) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">Delete</button>
                </form>
            </div>
        </div>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            @csrf
            @method('PUT')
            <input type="text" name="name" class="note-name" placeholder="Enter note name"
                value="{{ $note->name }}">
            <textarea name="note" rows="10" class="note-body" placeholder="Enter your note here">{{ $note->note }}</textarea>
            <div class="note-tags">
                <h2 class="py-4 text-2xl">Tags</h2>
                @foreach ($note->tags as $tag)
                    <span class="tag">{{ $tag->name }}</span>
                @endforeach
                <select name="tags[]" multiple>
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
