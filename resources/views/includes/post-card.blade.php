<div class="bg-indigo-100 border-l-4 border-indigo-500 p-4 rounded shadow-md">
    <a class="font-semibold text-2xl text-indigo-800" href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a>
    <p class="text-indigo-600 mt-2">{{ $post->excerpt }}</p>
</div>
