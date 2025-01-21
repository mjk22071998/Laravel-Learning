<x-master>
    <div class="mx-10 grid grid-cols-12">
        <div class="col-span-10 col-start-2">
            <!-- Post Title and Body -->
            <div class="text-3xl font-bold">{{ $post->title }}</div>
            <div class="my-4">{{ $post->body }}</div>

            <!-- Comment Form -->
            @auth
                <!-- Form for authenticated users -->
                <form class="flex flex-row items-center mb-6" action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="body" rows="4" class="mt-1 block flex-grow px-4 py-2 border border-slate-300 rounded-lg 
                        focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
                        dark:border-slate-600 dark:focus:ring-white resize-none"
                        placeholder="Add a comment..." required></textarea>
                    <x-button type="submit" class="m-2" label="Post Comment" />
                </form>
            @else
                <!-- Form for anonymous users -->
                <form class="flex flex-row items-center mb-6" action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="body" rows="4" class="w-full p-2 border border-slate-300 rounded"
                        placeholder="Add a comment as anonymous..." required></textarea>
                    <x-button type="submit" class="m-2" label="Post Comment" />
                </form>
            @endauth

            <!-- Display Comments Section -->
            <div class="border-t-2 border-slate-800 pt-6 mb-6">
                <h3 class="font-semibold text-lg">Comments ({{ $post->comments->count() }})</h3>
            
                @if($post->comments->count() > 0)
                    <ul class="space-y-4">
                        @foreach($post->comments as $comment)
                            <li class="p-4 flex justify-between items-center border-b">
                                <!-- Comment Content -->
                                <div class="flex-1">
                                    <p><strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}:</strong>
                                        {{ $comment->body }}</p>
                                    <small class="text-slate-500">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>

                                <!-- Delete Button (visible only to the user who posted the comment) -->
                                @if (auth()->check() && auth()->id() == $comment->user_id)
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-800 hover:text-slate-600">
                                            <!-- SVG Icon for delete (X) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
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

