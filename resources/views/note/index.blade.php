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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                    clip-rule="evenodd"></path>
            </svg>
            <span>
                New Note
            </span>
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
