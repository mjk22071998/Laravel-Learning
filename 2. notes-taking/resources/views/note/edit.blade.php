<x-app-layout>
    <div class="note-container single-note">
        <h1 class="text-3xl py-4">Edit your note</h1>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            @csrf
            @method('PUT')
            <label for="title">Note Title</label><input id="title" value="{{ $note->name }}" type="text"
                name="title" class="note-body" required>
            <br />
            <label for="body">Enter Note body</label><br />
            <textarea rows="10" id="body" name="body" class="note-body multiline" required>{{ $note->note }}</textarea>
            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button type="submit" class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
