<div class="mt-6">
    <a class="text-2xl text-indigo-500 font-bold" href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a>
    <p class="text-gray-700">{{ $post->excerpt }}</p>
</div>
