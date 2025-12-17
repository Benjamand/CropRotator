<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author', 'user')->get();
        $user = auth()->user();

        return view('index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('create');
    }

    function search(Request $request) {
        $query = $request->input('searchBar');

        $data = Article::with('author', 'user')
    ->where('name', 'LIKE', '%' . $query . '%')
    ->get();

    
        return view('search', ['data' => $data]);
    }


    public function delete($id)
    {
        $article = Article::find($id);

        if ($article) {
            $article->delete();
            session()->flash('success', 'Article deleted successfully');
        } else {
            session()->flash('error', 'Article not found');
        }

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'authorName' => 'required|string|max:255',
            'articleName' => 'required|string|max:255',
            'content' => 'required|string|max:10000'
        ]);

        $author = Author::firstOrCreate([
            'name' => $request->authorName
        ]);
        

        $article = new Article();
        $article->name = $request->input('articleName');
        $article->content = $request->input('content');
        $article->author_id = $author->id;
        $article->user_id = auth()->id();
        $article->save();

        session()->flash('success', 'Article saved successfully');

        return redirect()->route('index');
    }

    public function patch(Request $request)
    {
        $article = Article::find($request->input('id'));
        $author = Author::find($article->author_id);

        if (!empty($request->input('name'))) {
            $article->name = $request->input('name');
            $article->save();
        }

        if (!empty($request->input('authorName'))) {
            $author->name = $request->input('authorName');
            $author->save();
        }

        session()->flash('success', 'Article updated successfully');

        $article = Article::find($article->id);
        $author = Author::find($article->author_id);

        return view('show', [
            'article' => $article,
            'author' => $author
        ]);
    }

    public function remove(Request $request)
    {
        $article = new Article();
        $article->name = $request->input('name');
        $article->save();

        session()->flash('success', 'Article saved successfully');

        return redirect()->route('index');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->intended('/');
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }

    public function articles()
    {
        $articles = Article::with('author', 'user')->get();

        return response()->json([
            'articles' => $articles
        ]);
    }

    public function articlesUser()
    {
        $user = auth()->user();

        $articles = Article::where('user_id', $user->id)
            ->with('author', 'user')
            ->get();

        return response()->json([
            'articles' => $articles
        ]);
    }

    public function show($id)
    {
        $article = Article::find($id);
        $author = Author::find($article->author_id);

        return view('show', [
            'article' => $article,
            'author' => $author
        ]);
    }
}
