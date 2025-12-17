@extends('layout')

@section('styles')
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: green;
        }

        h1 {
            font-size: 30px;
            color: Black;
        }
    </style>
@endsection

@section('content')

    <body>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <h1>Profile of {{ auth()->user()->name }}</h1>

        <h1 style="font-size: 25px">
            List of Articles created by {{ auth()->user()->name }}
        </h1>

        <ul id="article-list"></ul>

        <script>
            let csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            let isAuthenticated = @json(auth()->check());
            let articleCache = new Map();

            fetchData();
            setInterval(fetchData, 5000);

            function fetchData() {
                fetch("/articlesUser")
                    .then(res => res.json())
                    .then(data => {
                        const articleList = document.getElementById('article-list');
                        const currentIds = new Set(data.articles.map(a => a.id));

                        // Remove deleted articles
                        articleCache.forEach((_, id) => {
                            if (!currentIds.has(id)) {
                                document.getElementById(`article-${id}`)?.remove();
                                articleCache.delete(id);
                            }
                        });

                        // Add new articles
                        data.articles.forEach(article => {
                            if (!articleCache.has(article.id)) {
                                const li = document.createElement('li');
                                li.id = `article-${article.id}`;
                                li.className = "mb-4 p-4 border rounded";

                                li.innerHTML = `
                                        <p><b>Article Name:</b> ${article.name}</p>
                                        <p><b>Author:</b> ${article.author.name}</p>
                                    `;

                                // View button (same as index)
                                const viewButton = document.createElement('button');
                                viewButton.textContent = 'View';
                                viewButton.className = 'button';
                                viewButton.onclick = () => {
                                    window.location.href = `/articles/${article.id}`;
                                };

                                // Delete button
                                const deleteButton = document.createElement('button');
                                deleteButton.textContent = 'Delete';
                                deleteButton.className = 'button deleteButton';
                                deleteButton.onclick = () => {
                                    deleteArticle(article.id, li);
                                };

                                li.appendChild(document.createElement('br'));
                                li.appendChild(viewButton);
                                li.appendChild(deleteButton);

                                articleList.appendChild(li);
                                articleCache.set(article.id, article);
                            }
                        });
                    })
                    .catch(console.error);
            }

            function deleteArticle(articleId, listItem) {
                fetch(`/delete/${articleId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            listItem.remove();
                            articleCache.delete(articleId);
                        } else {
                            alert("Failed to delete article.");
                        }
                    })
                    .catch(console.error);
            }
        </script>

    </body>
@endsection