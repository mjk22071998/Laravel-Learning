<x-master>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <!-- Post Title and Body -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">{{ $post->title }}</h1>
            <div class="prose prose-lg dark:prose-invert text-slate-700 dark:text-slate-300">
                {!! $post->body !!}
            </div>
        </div>

        <!-- Comment Form -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-6 mb-8">
            @auth
                <!-- Form for authenticated users -->
                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="body" rows="4"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-slate-800 
                            dark:bg-slate-700 dark:text-white dark:border-slate-600 dark:focus:ring-white resize-none transition-all"
                        placeholder="Add a comment..." required></textarea>
                    <x-button type="submit" class="w-full sm:w-auto" label="Post Comment" />
                </form>
            @else
                <!-- Form for anonymous users -->
                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="body" rows="4"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-slate-800 
                            dark:bg-slate-700 dark:text-white dark:border-slate-600 dark:focus:ring-white resize-none transition-all"
                        placeholder="Add a comment as anonymous..." required></textarea>
                    <x-button type="submit" class="w-full sm:w-auto" label="Post Comment" />
                </form>
            @endauth
        </div>

        <!-- Display Comments Section -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-6">
            <h3 class="font-semibold text-2xl text-slate-900 dark:text-white mb-6">Comments
                ({{ $post->comments->count() }})</h3>

            @if ($post->comments->count() > 0)
                <ul class="space-y-4">
                    @foreach ($post->comments as $comment)
                        <li class="p-4 bg-slate-50 dark:bg-slate-700 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <!-- Comment Content -->
                                <div class="flex-1">
                                    <p class="text-slate-900 dark:text-white">
                                        <strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}:</strong>
                                        {{ $comment->body }}
                                    </p>
                                    <small
                                        class="text-slate-500 dark:text-slate-400">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>

                                <!-- Delete Button (visible only to the user who posted the comment) -->
                                @if (auth()->check() && auth()->id() == $comment->user_id)
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-slate-800 dark:text-slate-200 hover:text-slate-600 dark:hover:text-slate-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30"
                                                fill="currentColor">
                                                <path
                                                    d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-slate-600 dark:text-slate-400">No comments yet.</p>
            @endif
        </div>
    </div>
</x-master>