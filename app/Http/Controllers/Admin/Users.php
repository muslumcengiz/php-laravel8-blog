<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Users extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index(){
        $data=User::orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.users')->with('usersData', $data);
    }

    public function delete($id){
        $user=User::findOrFail($id);
        if($user->id==1 or $user->username=='admin')
            abort('403', 'İşlem engellendi. Admin kullanıcısı silinemez');
        return redirect()->back();
    }

    public function edit($id){
        $post=User::findOrFail($id);
        return view('admin.useredit')->with('user', $post);
    }

    public function update(Request $request, $id){
        $user=User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:20', 'unique:users,username,'.$user->id, 'regex:/\w*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['string', 'min:8', 'confirmed','nullable'],
            'status'=>['required','integer', 'min:0', 'max:1'],
        ]);

        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->username=$request->username;
        $user->email=$request->email;

        if($user->id==1 or $user->username=='admin')
            $user->status=1;
        else
            $user->status=$request->status;

        $user->syncRoles($request->userRole);

        if($request->password!='')
            $user->password=Hash::make($request->password);

        $user->save();
        return redirect()->back()->with('updatesuccess', true);
    }

    public function ban($id){
        $user=User::findOrFail($id);
        if($user->id==1 or $user->username=='admin')
            abort('403', 'Admin kullanıcısı banlanamaz');
        $user->status=0;
        $user->save();
        return redirect()->back()->with('updatesuccess', true);
    }

    public function unBan($id){
        $user=User::findOrFail($id);
        $user->status=1;
        $user->save();
        return redirect()->back()->with('updatesuccess', true);
    }
}
