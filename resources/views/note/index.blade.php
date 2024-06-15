<x-app-layout>
    <div class="py-12 note-container">
        <form class="search">
            <input type="search" class="search__input" placeholder="Search notes..." name="search"
                value="{{ request('search') }}">
            <button class="search__button" type="submit">Search</button>
        </form>

        <form method="GET" action="{{ route('note.index') }}" class="filter">
            <select name="tag" class="filter__select">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="filter__button">Filter</button>
        </form>


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
                <div class="note">
                    <div class="note__header">
                        <h3>{{ $note->name }}</h3>

                    </div>
                    <p class="note__body">
                        {{ Str::words($note->note, 30) }}
                    </p>
                    <div class="note__footer">
                        @foreach ($note->tags as $tag)
                            <span class="tag">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Open</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="note-delete-button">Delete</button>
                        </form>
                    </div>
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
