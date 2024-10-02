<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index() {
        return view('index');
    }

    public function create() {
        return view('create');

    }

    public function store() {
        
        return view('index');

    }
}
