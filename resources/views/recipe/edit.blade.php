@extends('adminlte::page')

@section('title', 'レシピ登録編集')

@section('content_header')
    <h1>レシピ編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ url('recipe/edit',  ['id'=>$recipe->id]) }}" id="edit">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">レシピ名</label>
                            <textarea class="form-control" id="name" name="name" placeholder="レシピ名" wrap="hard">{{ old('name', $recipe->name) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="url">レシピURL</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $recipe->url) }}" placeholder="レシピのリンク">
                        </div>
                        <div class="form-group">
                            <label for="comment">コメント</label>
                            <textarea class="form-control" id="comment" name="comment" placeholder="コメント" wrap="hard">{{ old('comment', $recipe->comment) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="foods" class="text-md-right">使用食材</label>
                            <div>
                                <select multiple class="form-control" id="foods" name="foods[]">
                                    @foreach ($foods as $food)
                                    <option value="{{ $food->id }}" {{ $recipe->foods->contains($food->id) ? 'selected' : '' }}>{{ $food->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="days">作成日追加</label>
                            <div>
                                <input type="date" name="dayname" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="days">現在の作成日一覧</label>
                            <div class="h5">
                            @isset ($recipe->days)
                                @foreach ($recipe->days()->orderBy('dayname', 'desc')->get() as $day)
                                <span class="badge badge-pill badge-secondary">{{ $day->dayname }}</span>
                                @endforeach
                            @endisset
                            @if ($recipe->days->isEmpty())
                                <span class="badge badge-pill badge-secondary">未設定</span>
                            @endif
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" form="edit">登録</button>
                        <button type="submit" class="btn btn-danger" form="delete" onclick='return confirm("「本レシピ情報を削除してもよろしいですか");'>削除</button>
                    </div>
                <form method="POST" action="{{ url('recipe/destroy', ['id'=>$recipe->id]) }}" id="delete">
                {{ csrf_field()}}
                {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
