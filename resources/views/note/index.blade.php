<x-app-layout>
    <div class="py-12 note-container">
        <form>
            <div class="search">
                <input type="search" class="search__input" placeholder="Search notes..." name="search"
                    value="{{ request('search') }}">
                <button class="search__button" type="submit">Search</button>
            </div>
        </form>
        @foreach ($tags as $tag)
            <a class="tag" href="{{ route('note.index', ['tag' => $tag->name]) }}"
                class="tag">{{ $tag->name }}</a>
        @endforeach


        <a href="{{ route('note.create') }}" class="new-note-btn">
            New Note
        </a>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="notes">
            @forelse ($notes as $note)
                <div class="note" href="{{ route('note.show', $note) }}">
                    <div class="note-header">
                        <h3 class="px-2 py-4 text-2xl">{{ $note->name }}</h3>
                    </div>
                    <div class="note-body">
                        {{ Str::words($note->note, 30) }}
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.show', $note) }}" class="note-edit-button">View</a>
                        <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="note-delete-button">Delete</button>
                        </form>
                    </div>
                    @foreach ($note->tags as $tag)
                        <span class="tag">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @empty
                <p>No notes found</p>
            @endforelse
        </div>

        <div class="p-6">
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
