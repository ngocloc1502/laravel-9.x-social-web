<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Models\NewsView;
use App\Models\NewsComments;
use App\Models\Categories;
use App\Models\PostMenu;
use App\Models\FormReport;
use App\Models\Reports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;

class NewsController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user() ? Auth::id() : 0;

            return $next($request);
        });
    }

    public function isAdmin($id = [1])
    {
        $query = User::find($this->user_id);

        if (is_null($query)) { 
            return 0;
        }
        
        return $query->getRoles()->whereIn('id', $id)->exists() ? 1 : 0;
    }

    public function checkAuthor($table, $id)
    {
        if ($this->isAdmin()){
            return true;
        }

        $post = DB::table($table)->select('user_id')->find($id);

        return $this->user_id == $post->user_id ? true : false;
    }

    public function index($id = null)
    {
        if ($id === null) {
            $categories = Categories::with('getNewsRelation')->get();

            $featured = News::withCount('getUserViewsRelation', 'getCommentsRelation')
            ->where('status', 0)
            ->whereMonth('updated_at' , now())
            ->orderBy('get_user_views_relation_count', 'desc')
            ->take(4)
            ->get();

            $news = News::withCount('getUserViewsRelation', 'getCommentsRelation')
            ->where('status', 0)
            ->whereMonth('updated_at' , now())
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

            return view('news.index', compact('categories', 'featured', 'news'));
        }else {
            $post = News::withCount('getUserViewsRelation', 'getCommentsRelation')
            ->where('status', 0)
            ->whereMonth('updated_at' , now())
            ->where('id', $id)
            ->first();

            $article = News::with('getUserRelation')
            ->withCount('getUserViewsRelation')
            ->where('category_id', $post->category_id)
            ->orderBy('get_user_views_relation_count', 'desc')
            ->take(3)
            ->get();

            if (is_null($post) || $post->count() == 0) {
                alert()->error('Oops..', 'Bài viết này không tồn tại');

                return redirect('news');
            }

            NewsView::updateOrCreate([
                'news_id' => $id,
                'user_id' => $this->user_id,
            ]);

            $group = $this->checkAuthor('news', $id) ? 1 : 2;

            $menu = PostMenu::where('group', $group)->get();
            
            return view('news.detail', compact('post', 'article', 'menu'));
        }
    }

    public function create()
    {
        if ($this->isAdmin([1, 2])) {
            $categories = Categories::all();

            return view('news.create', compact('categories'));
        }
        
        alert()->error('Oops..', 'Bạn không không thể tạo tin tức!');
        return redirect('news');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'max: 200'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif','max:2048'],
            'category' => ['required',],
            'content' => ['required']
        ]);

        $name = time().$request->file('photo')->hashName();

        $path = $request->file('photo')->storeAs('public/images', $name);

        $post = News::create([
            'title' => $request->title,
            'image' => $name,
            'introduction' => $request->introduction,
            'content' => $request->content,
            'category_id' => $request->category,
            'user_id' => Auth::id(),
        ]);

        toast('Thành công','success');

        return redirect()->route('news.show', ['id' => $post->id]);
    }

    public function edit($id)
    {
        $rules = $this->isAdmin() ? $this->isAdmin() : $this->checkAuthor('news', $id);

        if (!$rules) { 
            alert()->error('Oops...','Bạn không thể chỉnh sửa nội dung bài viết');

            return redirect('news');
        }

        $news = News::where([
            ['id', $id],
            ['status', 0]
        ])
        ->first();
        
        $categories = Categories::all();
        
        if ($news->count() == 0) {

            alert()->error('Oops...','Bài viết này không tồn tại');
    
            return redirect('news');
        }
        
        return view('news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['string', 'max: 200'],
            'category' => ['required'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif','max:2048'],
            'content' => ['required'],
        ]);

        $query = News::where('id', $id);
        
        $result = $query->update([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'content' => $request->content,
            'category_id' => $request->category,
            'updated_at' => now(),
        ]);

        if ($request->has('photo')){
            $name = time().$request->file('photo')->hashName();

            $path = $request->file('photo')->storeAs('public/images', $name);

            $query->update([
                'image' => $name,
            ]);
        }

        return redirect()->route('news.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $rules = $this->isAdmin() ? $this->isAdmin() : $this->checkAuthor('news', $id);

        if (!$rules) { 
            alert()->error('Oops...','Bạn không thể xóa nội dung bài viết');

            return redirect('news');
        }

        $query = News::find($id)->update(['status' => 1]);

        $tmp = Reports::where([
            ['table', 'news'],
            ['post_id', $id],
        ])->update(['status' => 1]);

        alert()->success('Thành công', 'Bài viết đã được xóa');
        
        return redirect('news');
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
        'contentComments' => ['required'],
        ]);

        $result = NewsComments::create([
            'content' => $request->contentComments,
            'user_id' => Auth::id(),
            'news_id' => $id,
        ]);

        return redirect()->route('news.show', ['id' => $id]);
    }

    public function updateComment(Request $request, $postId, $commentId)
    {
        if (! $this->checkAuthor('news_comments', $commentId)) { 
            alert()->error('Opps..', 'Không thể sửa bài viết!');
        
            return redirect()->back();
        }
        $request->validate([
            'contentComments' => ['required'],
        ]);

        $query = NewsComments::find(
            $commentId)->update([
            'content' => $request->contentComments,
            'updated_at' => now(),
        ]);
 
        alert()->success('Thành công!', 'Đã cập nhật nôi dung bình luận!');
        return redirect()->route('news.show', ['id' => $postId]);
    }

    public function destroyComment($postId, $commentId)
    {
        if (! $this->checkAuthor('news_comments', $commentId)) { 
            alert()->error('Opps..', 'Không thể sửa bài viết!');
        
            return redirect()->back();
        }
        
        $query = NewsComments::find($commentId)->update([
            'status' => 1,
            'updated_at' => now(),
        ]);

        alert()->success('Thành công!', 'Đã xóa bình luận');
        return redirect()->route('news.show', ['id' => $postId]);
    }

    public function storeLike($id)
    {
        $query = BlogLikes::where([
            ['blog_id', $id],
            ['user_id', Auth::id()],
        ]);

        if ($query->exists()) {
            $tmp = $query->first();

            $result = $tmp->status == 0 ? 
                $query->update(['status' => 1 ]) :
                $query->update(['status' => 0 ]) ;
    
        }else {
            BlogLikes::updateOrCreate([
                'blog_id' => $id,
                'user_id' => Auth::id(),
                'status' => 0
            ]);    
        }

        return redirect()->back();
    }

    public function hiden($id)
    {
        alert()->info('Đã tiếp nhận phản hồi', 'Chúng tôi sẽ không hiển thị các bài viết tương tự.');
        
        return redirect('news');
    }

    public function report($id)
    {
        $form = FormReport::all();

        return view('news.report', compact('id', 'form'));
    }

    public function storeReport(Request $request, $id)
    {   
        $request->validate([
            'checks.*' => ['required'],
        ]);

        $query = UserReports::create([   
            'user_id' => Auth::id(),
            'table' => 'news',
            'post_id' => $id,
            'content' => $request->content,
        ]);

        if($request->has('checks')) {
            $checks = $request->checks;

            foreach ($checks as $row) {
                $result = $query->getPostReportsRelation()->create([
                    'form_id' => $row,
                ]);
            }
        }

        alert()->info('Đã tiếp nhận phản hồi', 'Cám ơn bạn đã báo cáo với chúng tôi!');
        return redirect('news');
    }
}