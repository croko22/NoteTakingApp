<x-app-layout>
    <div class="note-container single-note">
        <h1 class="py-4 text-3xl">Create new tag</h1>
        <form action="{{ route('tag.store') }}" method="POST" class="note">
            @csrf
            <input type="text" name="name" class="note-name" placeholder="Enter note name">

            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
