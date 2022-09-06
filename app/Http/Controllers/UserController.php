<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\PostMenu;

class UserController extends Controller
{   
    public function index($id = null)
    {
        $user_id = is_null($id) ? Auth::id() : $id;
        
        if (is_null(User::find($user_id))) {
            alert()->error('Oops..', 'Người dùng không tồn tại!');

            return redirect()->back();
        }

        $info = User::find($user_id);

        $blogs = Blog::with('getUserRelation', 'getImagesRelation', 'getCommentsRelation.getUserRelation')
        ->withCount('getUserViewsRelation', 'getImagesRelation')
        ->orderBy('created_at', 'desc')
        ->where([
            ['user_id', $user_id],
            ['status', 0]
        ])
        ->get();

        if (Auth::user()->getRoles->where('id', 1)->count() == 1 || is_null($id)) {
            $menu = PostMenu::where('group', 1)->get();
        } else {
            $menu = PostMenu::where('group', 2)->get();
        }
        
        return view('user.info', compact('info', 'blogs', 'menu'));
    }

    public function edit($id = null)
    {
        $info = User::find(Auth::id());
        
        return view('user.edit', compact('info'));
    }

    public function update(Request $request) {
        $timestamp = strtotime($request->birthday_day.'-'.$request->birthday_month.'-'.$request->birthday_year);
        
        $date = date('Y-m-d', $timestamp);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'max:12'],
            'sex' => ['required'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif','max:2048'],
            'description' => ['required']
        ]);
        
        $user = User::find(Auth::id());

        $user->update([
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'sex' => $request->sex,
            'birthday' => $date,
            'description' => $request->description,
        ]);

        if($request->hasFile('photo')) {
            $name = "avt_".$request->file('photo')->hashName();

            $path = $request->file('photo')->storeAs('public/avatars', $name);

            $user->update([
                'avatar' => $name,
            ]);
        }

        toast('Cập nhật thông tin thành công!','success');
        return redirect('profile');
    }
}
