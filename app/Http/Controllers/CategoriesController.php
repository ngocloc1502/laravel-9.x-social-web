<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\News;
use App\Models\Blog;

class CategoriesController extends Controller
{
    public function index($name = null)
    {
        $query = News::withCount('getUserViewsRelation')->where('status', 0)
        ->orderBy('get_user_views_relation_count', 'desc');

        if (is_null($name)) {
            $posts = $query->paginate(20);
        } else { 
            $category = Categories::select('id', 'name')->where('uri', '/categories/'.$name)->first();

            if ($category->count() == 0) { 
                alert()->error('Oops..', 'Danh mục này không tồn tại!');

                return redirectO()->back();
            } else {
                $posts = $query->where('category_id', $category->id)->paginate(15);
            }
        }

        return view('news.categories', compact('posts', 'category'));
    }

    public function search(Request $request)
    {
        $newsPosts = News::withCount('getUserViewsRelation')
        ->orderBy('get_user_views_relation_count', 'desc')
        ->where('status', 0)
        ->where('title', 'like', '%'.$request->search.'%')
        ->orWhere('content', 'like', '%'.$request->search.'%')
        ->paginate(5);

        $blogPosts = Blog::withCount('getUserViewsRelation')
        ->orderBy('get_user_views_relation_count', 'desc')
        ->where('status', 0)
        ->Where('content', 'like', '%'.$request->search.'%')
        ->paginate(5);

        return view('layouts.search', compact('newsPosts', 'blogPosts'));
    }
}
