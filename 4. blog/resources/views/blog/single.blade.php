<x-master>
    <div class="mx-10 grid grid-cols-12">
        <div class="col-span-10 col-start-2">
            <!-- Post Title and Body -->
            <div class="text-3xl font-bold">{{ $post->title }}</div>
            <div class="my-4">{!! $post->body !!}</div>

            <!-- Comment Form -->
            @auth
                {{-- Form for authenticated users --}}
                <form class="flex flex-row items-center mb-6" action="{{ route('comment.store', $post->id) }}" method="POST"
                    class="mt-4">
                    @csrf
                    <textarea name="body" rows="4"
                        class="mt-1 block flex-grow px-4 py-2 border border-slate-300 rounded-lg 
                        focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
                        dark:border-slate-600 dark:focus:ring-white resize-none"
                        placeholder="Add a comment..." required></textarea>
                    <x-button type="submit" class="m-2" label="Post Comment" />
                </form>
            @else
                <!-- Form for anonymous users -->
                <form class="flex flex-row items-center mb-6" action="{{ route('comment.store', $post->id) }}"
                    method="POST" class="mt-4">
                    @csrf
                    <textarea name="body" rows="4" class="mt-1 block flex-grow px-4 py-2 border border-slate-300 rounded-lg"
                        placeholder="Add a comment as anonymous..." required></textarea>
                    <x-button type="submit" class="m-2" label="Post Comment" />
                </form>
            @endauth

            <!-- Display Comments Section -->
            <div class="border-t-2 border-slate-800 pt-6 mb-6">
                <h3 class="font-semibold text-lg">Comments ({{ $post->comments->count() }})</h3>

                @if ($post->comments->count() > 0)
                    <ul class="space-y-4">
                        @foreach ($post->comments as $comment)
                            <li class="p-4 flex justify-between items-center border-b">
                                <!-- Comment Content -->
                                <div class="flex-1">
                                    <p><strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}:</strong>
                                        {{ $comment->body }}</p>
                                    <small class="text-slate-500">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>

                                <!-- Delete Button (visible only to the user who posted the comment) -->
                                @if (auth()->check() && auth()->id() == $comment->user_id)
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST"
                                        class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-800 hover:text-slate-600">
                                            {{-- SVG Delete icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 30 30">
                                                <path
                                                    d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-slate-600">No comments yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-master>
