<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Article's Details") }}
        </h2>
    </x-slot>
    <div class="w-10/12 m-auto">
        <div class="mt-7 text-white">
            <a href="{{ url('/articles') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"><i
                    class="fas fa-angle-left mr-1"></i>Back</a>
        </div>
        @if (session('info'))
            <div class="px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg w-full mt-6">
                <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
            </div>
        @endif
        <div class="w-full  mt-6 px-5 py-3 bg-white shadow-md overflow-hidden rounded-lg">

            <div class="p-5 text-gray-900">
                <h1 class="font-bold text-lg">{{ $article->title }}</h1>
                <b class="text-indigo-500 mr-1">
                    {{ $article->user->name }}
                </b>
                <i class="text-teal-600 text-sm font-semibold">{{ $article->category->name }}</i> <br>
                <small class="text-slate-500">{{ $article->created_at->diffForHumans() }}</small>
                <p class="">{{ $article->body }}</p>
                @auth
                    @can('article-delete', $article)
                        <div class="mt-4 text-white text-sm font-semibold">
                            <a href="{{ url("/articles/edit/$article->id") }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"><i
                                    class="fas fa-pen-nib mr-1"></i>Edit</a>
                            <a href="{{ url("/articles/delete/$article->id") }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"><i
                                    class="fas fa-trash mr-1 "></i>Delete</a>
                        </div>
                    @endcan
                @endauth
            </div>
        </div>
        <hr>
        <div class="w-full  mt-6 px-4 py-2 bg-white shadow-md overflow-hidden rounded-lg">
            <div class=" text-gray-900">
                <ul>
                    <li class="font-semibold py-2 border-b-2"> Comments ({{ count($article->comments) }})</li>
                    @foreach ($article->comments as $comment)
                        <li class="py-2 rounded-md border-0">
                            <i class="text-indigo-500 mr-1 font-semibold">
                                {{ $comment->user->name }}
                            </i> -
                            {{ $comment->content }}
                            @auth
                                @can('comment-delete', $comment)
                                    <a href="{{ url("/comments/delete/$comment->id") }}"><i
                                            class="fas fa-close float-right text-slate-500"></i></a>
                                @endcan
                            @endauth
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-full mt-6 px-4 py-2 bg-white shadow-md overflow-hidden rounded-lg">
            <form action="{{ url('/comments/add') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea type="text" name="content" class="bg-gray-100 hover:ring-indigo-500 w-full border-gray-300 rounded-md my-2"></textarea>
                <x-primary-button>
                    <i class="fas fa-paper-plane mr-1"></i> {{ __('Send') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
