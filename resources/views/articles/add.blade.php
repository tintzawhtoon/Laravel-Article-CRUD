<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Article') }}
        </h2>
    </x-slot>
    <div class="w-9/12 m-auto">
        @if ($errors->any())
            <div class="px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg w-full mt-6">
                <i class="fas fa-info-circle mr-2"></i>
                @foreach ($errors->all() as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif
        <div class="w-full  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <form action="{{ url("/articles/add") }}" method="post">
                @csrf
                <div class="my-2">
                    <label for="title" class="mb-1">Title</label>
                    <input type="text" id="title" name="title" class="bg-gray-100 hover:ring-indigo-500 w-full border-gray-300 rounded-md">
                </div>
                <div class="my-2">
                    <label for="body" class="mb-1">Body</label>
                    <textarea name="body" id="body" rows="5" class="bg-gray-100 hover:ring-indigo-500 w-full border-gray-300 rounded-md"></textarea>
                </div>
                <div class="my-2">
                    <label for="category" class="mb-1">Category</label>
                    <select name="category_id" id="category" class="bg-gray-100 hover:ring-indigo-500 w-full border-gray-300 rounded-md ">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="my-2">
                    <x-primary-button>
                        {{ __('Create Article') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
