<div class="bg-gray-100 p-4 rounded shadow-md">
    <a class="title title-accent underline" href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a>
    <p class="subtext mt-2">{{ $post->excerpt }}</p>
</div>
