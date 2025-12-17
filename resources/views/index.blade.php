@extends('layout')

@section('content')

    @if(session('success'))
        <div class="mb-6 rounded bg-green-100 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold mb-2">Articles</h1>

    @if($user)
        <p class="text-gray-600 mb-6">
            Welcome back, <span class="font-medium">{{ $user->name }}</span>
        </p>
    @endif

    @if($errors->any())
        <div class="mb-6 rounded bg-red-100 text-red-800 px-4 py-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('search') }}" method="POST" class="flex gap-2 mb-8 max-w-xl">
        @csrf

        <input type="text" name="searchBar" placeholder="Search articles..."
            class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
            Search
        </button>
    </form>

    <ul id="article-list" class="grid gap-4"></ul>


    <script>
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let isAuthenticated = @json(auth()->check());
        let articleCache = new Map();

        fetchData();
        setInterval(fetchData, 5000);

        function fetchData() {
            fetch("/articles")
                .then(res => res.json())
                .then(data => {
                    const articleList = document.getElementById('article-list');
                    const currentIds = new Set(data.articles.map(a => a.id));

                    articleCache.forEach((_, id) => {
                        if (!currentIds.has(id)) {
                            document.getElementById(`article-${id}`)?.remove();
                            articleCache.delete(id);
                        }
                    });

                    data.articles.forEach(article => {
                        if (!articleCache.has(article.id)) {
                            const li = document.createElement('li');
                            li.id = `article-${article.id}`;
                            li.innerHTML = `
                                                                                                                    <b>Article Name:</b> ${article.name}<br>
                                                                                                                    <b>Author name:</b> ${article.author.name}<br>
                                                                                                                    <b>Created by user:</b> ${article.user.name}<br>
                                                                                                                `;
                            const viewButton = document.createElement('button');
                            viewButton.textContent = 'View';
                            viewButton.classList.add('button');

                            viewButton.addEventListener('click', () => {
                                window.location.href = `/articles/${article.id}`;
                            });

                            li.appendChild(document.createElement('br'));
                            li.appendChild(viewButton);
                            li.className =
                                "bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition";

                            viewButton.className =
                                "mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600";


                            articleList.appendChild(li);
                            articleCache.set(article.id, article);
                        }
                    });
                })
                .catch(console.error);
        }
    </script>

@endsection