@extends('layout')
@section('content')
    <a href="{{ route('create') }}" class="button">Go to Creation</a>

    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: green;
        }
    </style>
@endsection


