<x-layout>
    <div class="note-container single-note">
        <h1 class="text-3xl py-4">Create New Note</h1>
        <form action="{{ route('note.store') }}" method="POST" class="note">
            @csrf
            @method('post')
            <label for="title">Node Title</label><input id="title" type="text" name="name" class="note-body"
                required><br />
            <label for="body">Enter Note body</label><br />
            <textarea id="body" rows="10" name="note" class="note-body multiline" required></textarea>
            <div class="note-buttons">
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <button type="submit" class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-layout>
