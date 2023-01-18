<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * マイアカウント表示
     *  
     * @param Request $request
     * @return Response
     */
    public function myAccount(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('user.edit', compact('user'));
    }

    /**
     * 編集内容の登録
     * 
     * @param $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
            'email' => 'required|email',
        ]);
        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
            return redirect('/');
    }

    /**
    * 登録情報の削除
    * 
    * @param Request $request
    * @return Response
    */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if(Auth::id() == $user->id){
            $user->delete();
            return redirect('/login');
            }else{
            $user->delete();
            return redirect('/');
        }
    }

}
