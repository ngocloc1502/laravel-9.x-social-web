<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inform;
use App\Models\UserProgress;

class InformController extends Controller
{
    public function index($id = null)
    {   
        if (is_null($id)) {
            $inform = Inform::with('getUserRelation','getUserProgessRelation')
            ->orderBy('deadline', 'desc')
            ->orderBy('status', 'asc')
            ->where('status', 0)
            ->paginate(15);

            return view('inform.index', compact('inform'));
        } else {
            $inform = Inform::find($id);

            if (is_null($inform) || $inform->status === 1) {
                alert()->error('Oops...', 'Không tìm thấy báo cáo!');

                return redirect()->back();
            }
            
            return view('inform.show', compact('inform'));
        }
    }

    public function create()
    {
        $users = User::rightJoin('admin_role_users', 'users.id', '=', 'admin_role_users.user_id')
        ->where([
            ['role_id', 2],
            ['status', 0]
        ])
        ->get();

        dd($users);

        // return ;
    }

    public function store(Request $request)
    {
        $request->validate([
            'uri' => ['required'],
            'messages' => ['required'],
        ]);


        $user = User::rightJoin('admin_role_users', 'users.id', '=', 'admin_role_users.user_id')
        ->where([
            ['role_id', 2],
            ['name', $request->name]
        ])
        ->first();

        $timestamp = strtotime($request->day.'-'.$request->month.'-'.$request->year);
        
        $date = date('Y-m-d H:i:s', $timestamp);

        $query = Inform::create([
            'messages' => $request->messages,
            'user_id' => $user->id,
            'deadline' => $date,
        ]);

        toast('Đã gửi thông báo','success');

        return redirect('notifications');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $query = Inform::find($id)->update([
            'status' => 1,
        ]);

        toast('Thành công','success');

        return redirect('report');
    }
}
