<x-app-layout>
    <div class="py-12 note-container">
        <a href="{{ route('tag.create') }}" class="new-note-btn">
            New Tag
        </a>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="notes">
            @forelse ($tags as $tag)
                <div class="note" href="{{ route('note.show', $tag) }}">
                    <div class="note-header">
                        <h3 class="px-2 py-4 text-2xl">{{ $tag->name }}</h3>
                    </div>

                    <div class="note-buttons">
                        <a href="{{ route('tag.edit', $tag) }}" class="note-edit-button">Edit</a>
                        <form action="{{ route('tag.destroy', $tag) }}" method="POST">
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

        {{-- <div class="p-6">
            {{ $tags->links() }}
        </div> --}}
    </div>
</x-app-layout>
