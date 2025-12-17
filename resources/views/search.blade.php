@extends('layout')
@section('content')

    <h2 class="name-header">Article Name</h2>

    @if(count($data) != 0)
        <table>
            <thead>
            </thead>
            <tbody>
                @foreach ($data as $article)
                    <tr>
                        <td>
                            <div class="articleEntry">
                                <a class="search-name" href="{{ url('/articles/' . $article->id) }}">
                                    {{ $article->name }}
                                </a>

                                <div class="search-author">
                                    Author: {{ $article->author->name ?? 'Unknown' }}
                                </div>

                                <div class="search-user">
                                    Created by: {{ $article->user->name ?? 'Unknown' }}
                                </div>

                                <a class="search-name" href="{{ url('/articles/' . $article->id) }}">
                                    {{ $article->name }}
                                </a>
                                <button class="button" onclick="window.location.href='{{ url('/' . $article->id) }}'">
                                    View
                                </button>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="name-column">No articles found.</p>
    @endif

@endsection