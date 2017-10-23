<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->get();
        $post[0]->views++;
        $post[0]->save();
        return view('blog.post', ['post' => $post[0]]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::where('title', 'LIKE', "%{$search}%")
                ->where('status', 1)
                ->paginate(10);

        return view('blog.search', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('blog.category', compact('posts'));

    }
}
