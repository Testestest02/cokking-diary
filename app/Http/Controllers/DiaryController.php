<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Day;

class DiaryController extends Controller
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
     * 調理日記一覧
     */
    public function index()
    {
        // 作成日順にレシピ一覧取得
        $days = Day::with('recipe')->orderBy('dayname', 'desc')->get();
        $users = Day::with('user')->get();


        return view('diary.index', compact('days', 'users'));
    }

    /**
     * 調理日記追加
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'recipe_id' => 'required',
                'dayname' => 'required',
            ]);
            // レシピ登録
            $day = Day::create([
                'user_id' => Auth::user()->id,
                'recipe_id' => $request->recipe_id,
                'dayname' => $request->dayname,
            ]);
            return redirect('/diary');
        }
        $recipes = Recipe::all();
        return view('diary.add', compact('recipes'));
    }

    /**
     * 調理日記削除
     */
    public function destroy(Request $request){
        $recipe = Day::find($request->id);
        $recipe->delete();
        return redirect('/diary');
    }
    

}
