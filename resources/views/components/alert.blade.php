<div class="mt-2 container mx-auto alert flex flex-row items-center bg-indigo-200 p-5 rounded border-l-4 border-indigo-500 shadow-sm">
    <div class="alert-icon flex items-center bg-indigo-100 border-2 border-indigo-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
        <span class="text-indigo-500">
            @include('includes.svg.caution')
        </span>
    </div>
    <div class="alert-content ml-4">
        <div class="alert-title font-semibold text-lg text-indigo-800">
            {{ $title }}
        </div>
        <div class="alert-description text-sm text-indigo-600">
            {{ $slot }}
        </div>
    </div>
</div>
