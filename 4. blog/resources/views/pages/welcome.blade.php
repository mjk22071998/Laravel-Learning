<x-public-master>
    {{-- Welcome Jumbotron --}}
    <div class="p-5 mx-10 mb-4 bg-slate-200 rounded-lg">
        <div class="container  py-5">
            <h1 class="text-4xl font-bold mb-4">Welcome to the blog</h1>
            <p class="text-lg text-slate-800 mb-6">
                This is the developer's first major project in their Laravel learning journey. Dive into a world of
                fresh insights, engaging stories, and thought-provoking ideas. The developer is excited to share
                valuable content that sparks curiosity and inspires you to explore more with every post!
            </p>
            <button
                class="px-6 py-3 bg-slate-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                Popular Post
            </button>
        </div>
    </div>
    {{-- Main Content --}}
    <div class="grid grid-cols-12 gap-4">
        {{-- Latest posts --}}
        <div class="col-span-8 p-4">
            <h2 class="text-2xl font-bold">Latest Posts</h2>

            <x-post title="Post Title"
                content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel purus ut velit gravida tincidunt. Curabitur gravida lorem vel libero feugiat, vel viverra orci vestibulum."
                buttonLabel="Read Full Article" />
            <x-post title="Post Title"
                content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel purus ut velit gravida tincidunt. Curabitur gravida lorem vel libero feugiat, vel viverra orci vestibulum."
                buttonLabel="Read Full Article" />
            <x-post title="Post Title"
                content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel purus ut velit gravida tincidunt. Curabitur gravida lorem vel libero feugiat, vel viverra orci vestibulum."
                buttonLabel="Read Full Article" />
            <x-post title="Post Title"
                content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel purus ut velit gravida tincidunt. Curabitur gravida lorem vel libero feugiat, vel viverra orci vestibulum."
                buttonLabel="Read Full Article" />
            <x-post title="Post Title"
                content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel purus ut velit gravida tincidunt. Curabitur gravida lorem vel libero feugiat, vel viverra orci vestibulum."
                buttonLabel="Read Full Article" />



        </div>
        {{-- Sidebar --}}
        <div class="col-span-4 p-4">
            <h2 class="text-2xl font-bold">Sidebar</h2>
        </div>
    </div>

</x-public-master>
