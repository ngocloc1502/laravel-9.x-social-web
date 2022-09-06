<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Models\Blog;
use App\Models\BlogView;
use App\Models\BlogImages;
use App\Models\BlogComments;
use App\Models\BlogLikes;
use App\Models\PostMenu;
use App\Models\FormReport;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    public function isAdmin($id = [1])
    {
        return User::find(Auth::id())->getRoles()->whereIn('id', $id)->exists() ? 1 : 0;
    }

    public function checkAuthor($table, $id)
    {
        if ($this->isAdmin()){
            return true;
        }

        $post = DB::table($table)->select('user_id')->find($id);

        $result = Auth::id() == $post->user_id ? true : false;

        return $result;
    }

    public function index($id = null)
    {
        $query = Blog::withCount('getUserViewsRelation', 'getImagesRelation', 'getUserLikesRelation')
        ->inRandomOrder();
     
        if ($id == null) {
            $blogs = $this->isAdmin([1, 2]) ? $query->paginate(10) : $query->wherea('sttus', 0)->paginate(15);

            return view('blogs.index', compact('blogs'));
        }else {
            if ($this->isAdmin() == 0 && Blog::where([['id', $id],['status', 1]])->exists()) {
                alert()->error('Opps..', 'Bài biết này không tồn tại!');

                return redirect('blog');
            }

            $post = $this->isAdmin() ? 
            $query->where('id', $id)->first() : 
            $query->where([
                            ['id', '=', $id],
                            ['status', '=', '0'],
                        ])
                        ->first();

            BlogView::updateOrCreate([
                'blog_id' =>  $post->id, 
                'user_id' => Auth::id()
            ],);

            $group = $this->checkAuthor('blogs', $id) ? 1 : 2;

            $menu = PostMenu::where('group', $group)->get();

            $comments = $this->isAdmin() ? $post->getCommentsRelation : $post->getCommentAlive;

            $article =  Blog::with('getUserRelation')
            ->withCount('getUserViewsRelation', 'getUserLikesRelation', 'getImagesRelation')
            ->where('user_id', $post->user_id)
            ->orderBy('get_user_views_relation_count', 'desc')
            ->orderBy('get_user_likes_relation_count', 'desc')
            ->paginate();

            return view('blogs.detail', compact('post', 'menu', 'comments', 'article'));
        }

    }

    public function create()
    {   
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([    
            'photos' => ['max:10000'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $content = is_null($request->content) ? '' : $request->content;

        $post = Blog::create([
            'content' => $content,
            'user_id' => Auth::id(),
        ]);

        if($request->hasFile('photos')) {

            $files = $request->file('photos');

            foreach ($files as $key => $file) {        
                $name = time().$file->hashName();

                $path = $file->storeAs('public/images', $name);

                $post->getImagesRelation()->create([
                    'image' => $name,
                    'width' => 360,
                    'height' => 360,
                ]);
            }
        }

        alert()->success('Thành công', 'Bài viết của bạn đã được tải lên');

        return redirect()->route('blog.show', ['id' => $post->id]);
    }

    public function edit($id)
    {
        $post = Blog::with('getUserRelation', 'getImagesRelation', 'getCommentsRelation.getUserRelation')
        ->withCount('getUserLikesRelation')
        ->where([
            ['id', $id],
            ['status', '0'],
        ])
        ->first();

        return view('blogs.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'photos' => ['max:10000'],
            'photos.*' => ['mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $post = Blog::find($id);
        
        $post->update([
            'content' => $request->content,
            'updated_at' => now(),
        ]);
                        
        $tmp = Reports::where([
            ['table', 'blogs'],
            ['post_id', $id],
        ])->update(['status' => 1]);

        if($request->hasFile('photos')) {

            $files = $request->file('photos');

            BlogImages::where('blog_id', $id)->update(['status' => 1]);

            foreach ($files as $key => $file) {
                $name = $file->hashName();
                    
                $path = $file->storeAs('public/images', $name);

                $post->getImagesRelation()->create([
                    'image' => $name,
                    'width' => 360,
                    'height' => 360,
                ]);
            }
        }

        alert()->success('Thành công', 'Bài viết đã được cập nhật');

        return redirect()->route('blog.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        if ($this->checkAuthor('blogs', $id)) {
            $post = Blog::find($id)->update(['status' => 1]);
                
            $tmp = Reports::where([
                ['table', 'blogs'],
                ['post_id', $id],
            ])->update(['status' => 1]);

            alert()->success('Thành công', 'Bài viết đã được xóa');
                    
            return redirect()->back();
        }else {
            alert()->error('Opps..', 'Bài biết này không tồn tại!');
        
            return redirect()->back();
        }
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'contentComments' => ['required'],
        ]);

        $result = BlogComments::create([
            'content' => $request->contentComments,
            'user_id' => Auth::id(),
            'blog_id' => $id,
        ]);

        return redirect()->back();
    }

    public function updateComment(Request $request, $postId, $commentId)
    {
        if (! $this->checkAuthor('blog_comments', $commentId)) { 
            alert()->error('Opps..', 'Không thể sửa bài viết!');
        
            return redirect()->back();
        }
        $request->validate([
            'contentComments' => ['required'],
        ]);

        $query = BlogComments::find($commentId)->update([
            'content' => $request->contentComments,
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }

    public function destroyComment($postId, $commentId)
    {
        if (! $this->checkAuthor('blog_comments', $commentId)) { 
            alert()->error('Opps..', 'Không thể sửa bài viết!');
        
            return redirect()->back();
        }
        
        $query = BlogComments::find($commentId)->update([
            'status' => 1,
            'updated_at' => now(),
        ]);

        return redirect()->back();
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
        
        return redirect('blog');
    }

    public function report($id)
    {
        $form = FormReport::all();

        return view('blogs.report', compact('id', 'form'));
    }

    public function storeReport(Request $request, $id)
    {   
        $request->validate([
            'checks.*' => ['required'],
        ]);

        $query = Reports::create([   
            'user_id' => Auth::id(),
            'table' => 'blogs',
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
        return redirect('blog');
    }
}
