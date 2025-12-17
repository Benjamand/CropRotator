@extends('layout')
@section('content')

    <script defer src="{{ asset('scripts/Form.js') }}"></script>

    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            Create Article
        </h1>

        <form id="form" action="{{ route('store') }}" method="POST" class="space-y-6">
            @csrf

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Article title -->
            <div>
                <label for="articleName" class="block text-sm font-medium text-gray-700">
                    Article title
                </label>
                <input type="text" id="articleName" name="articleName"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Release year -->
            <div>
                <label for="ryear" class="block text-sm font-medium text-gray-700">
                    Release year
                </label>
                <input type="number" id="ryear" name="ryear"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Author -->
            <div>
                <label for="authorName" class="block text-sm font-medium text-gray-700">
                    Author
                </label>
                <input type="text" id="authorName" name="authorName"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Content -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Content
                </label>
                <textarea id="content" name="content" rows="5"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Submit
                </button>
            </div>

        </form>
    </div>

@endsection