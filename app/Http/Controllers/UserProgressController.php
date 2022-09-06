<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inform;
use App\Models\UserProgress;
use App\Models\User;

class UserProgressController extends Controller
{
    public function index($id = null)
    {
        $query = Inform::with('getUserProgessRelation')
        ->where([
            ['user_id', Auth::id()],
            ['status', 0]
        ])
        ->orderBy('deadline', 'asc');

        $inform = is_null($id) ? $query->get() : $query->where('id', $id)->first();

        if ($inform->count() === 0) {
            return "nothing to do";
        }

        $count = is_null($id) ? 2 : ($inform->getUserProgessRelation->count());

        return view('progress.index', compact('inform', 'count'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'uri' => ['required'],
            'messages' => ['required'],
        ]);

        $query = UserProgress::create([
            'inform_id' => $id,
            'uri' => $request->uri,
            'note' => $request->messages,    
        ]);

        toast('Đã gửi báo cáo','success');

        return redirect('notifications');
    }

    public function edit($id)
    {
        $item = UserProgress::find($id);

        if (is_null($item)) {
            alert()->error('Oops...', 'Không tìm thấy bài viết');
            
            return redirect('notifications');
        }
        
        if ($item->getInformRelation->user_id != Auth::id()) {
            alert()->error('Oops...', 'Không tìm thấy bài viết');

            return redirect()->back();
        }

        return view('progress.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'uri' => ['required'],
            'messages' => ['required'],
        ]);

        $item = UserProgress::find($id);
        
        $query = $item->update([
            'uri' => $request->uri,
            'note' => $request->messages,
        ]);

        toast('Thành công','success');

        return redirect()->route('progress.show', ['id' => $item->inform_id]);
    }

    public function destroy($id)
    {
        $item = UserProgress::find($id);

        if (is_null($item)) {
            alert()->error('Oops...', 'Không tìm thấy bài viết');
            
            return redirect('notifications');
        }
        
        if ($item->getInformRelation->user_id != Auth::id()) {
            alert()->error('Oops...', 'Không tìm thấy bài viết');

            return redirect()->back();
        }

        $query = $item->update(['status' => 1]);

        toast('Thành công','success');

        return redirect()->route('progress.show', ['id' => $item->inform_id]);
    }

}
