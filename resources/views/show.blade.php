@extends('layout')

@section('content')

    <div class="max-w-3xl mx-auto space-y-8">

        <!-- Article details -->
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Article Details
            </h1>

            <div class="space-y-2 text-gray-700">
                <p>
                    <span class="font-semibold">ID:</span>
                    {{ $article->id }}
                </p>

                <p>
                    <span class="font-semibold">Title:</span>
                    {{ $article->name }}
                </p>

                <p>
                    <span class="font-semibold">Author:</span>
                    {{ $author->name }}
                </p>
            </div>

            <!-- Content -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">
                    Content
                </h2>
                <div class="bg-gray-50 border rounded p-4 text-gray-700 whitespace-pre-line">
                    {{ $article->content ?? 'No content provided.' }}
                </div>
            </div>
        </div>

        <!-- Edit form (only for owner) -->
        @auth
            @if(auth()->user()->id === $article->user_id)

                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        Edit Article
                    </h2>

                    <form id="form" action="{{ route('patch') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{ $article->id }}">

                        <!-- Update article name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Updated article name
                            </label>
                            <input type="text" id="name" name="name"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Update author name -->
                        <div>
                            <label for="authorName" class="block text-sm font-medium text-gray-700">
                                Updated author name
                            </label>
                            <input type="text" id="authorName" name="authorName"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Update content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">
                                Updated content
                            </label>
                            <textarea id="content" name="content" rows="5"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $article->content }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            @endif
        @endauth

    </div>

@endsection