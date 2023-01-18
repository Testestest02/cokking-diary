<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Food;
use App\Models\Day;

class RecipeController extends Controller
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
     * レシピ一覧
     */
    public function index()
    {
        // レシピ一覧取得
        $recipes = Recipe::all();
        $foods = Food::all();
        $days = Day::all();

        return view('recipe.index', compact('recipes', 'foods', 'days'));
    }

    /**
     * レシピ一覧（フード検索）
     */
    public function indexFood($name)
    {
        $recipes = Recipe::whereHas('foods', function($query) use($name) {
            $query->where('foods.name', $name);
        })->get();
        $foodName = $name;
        $days = Day::all();

        return view('recipe.index', compact('recipes', 'foodName', 'days'));
    }

    /**
     * レシピ登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:50',
                'url' => 'required|url',
                'comment' => 'max:100',
            ]);
            // レシピ登録
            $recipe = Recipe::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'url' => $request->url,
                'comment' => $request->comment,
                'task' => 'OFF',
            ]);
            $recipe->foods()->sync($request->foods);
            return redirect('/recipe');
        }

        $foods = Food::all();
        return view('recipe.add', compact('foods'));
    }

    /**
     * レシピ編集
     */
    public function edit(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:50',
                'url' => 'required|url',
                'comment' => 'max:100',
            ]);
            // レシピ登録
            $recipe = Recipe::find($request->id);
            $recipe->update([
                'name' => $request->name,
                'url' => $request->url,
                'comment' => $request->comment,
            ]);
            if (!empty($_POST['dayname'])){
            $day = Day::create([
                'user_id' => Auth::user()->id,
                'recipe_id' => $request->id,
                'dayname' => $request->dayname,
            ]);
            }
            $recipe->foods()->sync($request->foods);

            return redirect('/recipe');
        }
        $recipe = Recipe::find($request->id);
        $foods = Food::all();

        return view('recipe.edit', compact('recipe', 'foods'));
    }

    /**
     * レシピ削除
     */
    public function destroy(Request $request){
        $recipe = Recipe::find($request->id);
        $recipe->delete();

        return redirect('/recipe');
    }
    

    /**
     * レシピタスクON
     */
    public function taskOn(Request $request){
        $recipe = Recipe::find($request->id);
        $recipe->update([
            'name' => $recipe->name,
            'url' => $recipe->url,
            'comment' => $recipe->comment,
            'task' => 'ON',
        ]);

        return redirect('/recipe');
    }

        /**
     * レシピタスクOFF
     */
    public function taskOff(Request $request){
        $recipe = Recipe::find($request->id);
        $recipe->update([
            // 'name' => $recipe->name,
            // 'url' => $recipe->url,
            // 'comment' => $recipe->comment,
            'task' => 'OFF',
        ]);

        return redirect('/recipe');
    }

        /**
     * 食材登録
     */
    public function foodAdd(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:10|unique:foods',
            ]);
            // 食材登録
            Food::create([
                'name' => $request->name,
            ]);
            return redirect('/recipe');
        }
        return view('recipe.foodAdd');
    }

    /**
     * 食材編集
     */
    public function foodEdit(Request $request)
    {
        $foods = Food::all();

        return view('recipe.foodEdit', compact('foods'));
    }

    /**
     * 食材削除
     */
    public function foodDestroy(Request $request){
        // $food = Food::find($request->foods);
        $food = Food::where('id', $request->foods)->first();
        // dd($food);
        $food->delete();

        return redirect('/recipe');
    }

    /**
     * レシピタスク一覧
     */
    public function task()
    {
        //レシピ一覧取得 タスクがオンのもの限定
        $recipes = Recipe::where('recipes.task', 'ON')->select()->get();
        $foods = Food::all();

        return view('task.index', compact('recipes','foods'));
    }

    /**
     * レシピタスク消化
     */
    public function taskEnd(Request $request){
        $recipe = Recipe::find($request->id);
        $recipe->update([
            'name' => $recipe->name,
            'url' => $recipe->url,
            'comment' => $recipe->comment,
            'task' => 'OFF',
        ]);
        $day = Day::create([
            'user_id' => Auth::user()->id,
            'recipe_id' => $request->id,
            'dayname' => date('Y-m-d'),
        ]);

        return redirect('/task');
    }
    
    /**
     * レシピタスクを全て削除
     */
    public function taskAllOff(Request $request){
        $recipe = Recipe::where('task', 'ON');
        $recipe->update([
            'task' => 'OFF',
        ]);

        return redirect('/task');
    }
    

}
