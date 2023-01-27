<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>
    <div class="w-10/12 m-auto">
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
        @if (session("info"))
        <div class="px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg w-full mt-6">
            <i class="fas fa-info-circle mr-2"></i> {{ session("info") }}
        </div>
        @endif
        @foreach ($articles as $article)
            <div class="w-full  mt-6 px-5 py-3 bg-white shadow-md overflow-hidden rounded-lg">
                <div class="p-5 text-gray-900">
                    <h1 class="font-bold text-lg">{{ $article->title }}</h1>
                    <b class="text-indigo-500 mr-1">
                        {{ $article->user->name }}
                    </b>
                    <i class="text-teal-600 text-sm font-semibold">{{ $article->category->name }}</i> <br>
                    <small class="text-slate-500">{{ $article->created_at->diffForHumans() }}</small>
                    <p class="">{{ $article->body }}</p>
                    <i class="text-xs font-semibold text-slate-500">Comments ({{ count($article->comments) }})</i>
                    <div class="mt-1 text-sm text-indigo-500 hover:text-pink-500 underline">
                        <a href="{{ url("/articles/detail/$article->id") }}">View Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
