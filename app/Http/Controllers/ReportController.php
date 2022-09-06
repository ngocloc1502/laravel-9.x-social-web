<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\FormReport;
use App\Models\News;
use App\Models\Blog;
use App\Models\User;

class ReportController extends Controller
{
    public function index($id = null)
    {
        $reports = Reports::where('status', 0)->get();

        foreach ($reports as $key => $value) {
            if ($value->table = 'news'){
                $value->image =  News::select('image')->find($value->post_id);
            }
            else {
                $blogPost = Blog::find($value->post_id);

                $value->image = $blogPost->getImagesRelation->count() != 0 ? 
                $blogPost->getImagesRelation[0] :
                NULL;
            }
        }

        return view('reports.index', compact('reports'));
    }

    public function viewTop()
    {
        $blogPosts = Blog::withCount('getUserViewsRelation', 'getUserLikesRelation', 'getImagesRelation')
        ->orderByRaw('get_user_views_relation_count - updated_at desc')
        ->where('status', 0)
        ->get();

        $newsPosts = News::withCount('getUserViewsRelation')
        ->orderByRaw('get_user_views_relation_count - updated_at desc')
        ->take(5)
        ->get();

        $user = User::withCount('getNewsViewsRelation', 'getBlogViewsRelation', 'getBlogLikesRelation')
        ->where('status', 0)
        ->whereMonth('updated_at', now()->month)
        ->orderByRaw('get_news_views_relation_count - get_blog_views_relation_count - get_blog_likes_relation_count DESC')
        ->get();

        return view('reports.detail', compact('blogPosts', 'newsPosts', 'user'));
    }
}