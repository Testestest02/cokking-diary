@extends('adminlte::page')

@section('title', 'レシピ一覧')

@section('content_header')
<div class="d-flex mt-2">
    @isset($foodName)
    <h2>{{$foodName}}を使ったレシピ（{{$recipes->count()}}件）</h2>
    @else
    <h2>レシピ（{{$recipes->count()}}件）</h2>
    <div class="dropdown ml-auto">
        <button type="button" id="dropdown1" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">レシピ＆食材
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdown1">
            <a class="dropdown-item " href="{{ url('recipe/add') }}">レシピ登録</a>
            <a class="dropdown-item " href="{{ url('recipe/foodAdd') }}">食材登録</a>
            <a class="dropdown-item " href="{{ url('recipe/foodEdit') }}">食材削除</a>
        </div>
    </div>
    @endisset
</div>
@stop

@section('content')
<div class="p-4">
    <div class="row mb-3">
        @foreach ($recipes as $recipe)
        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-lg-0 p-4">
            <!-- レシピカード -->
            <div class="card @if ($recipe->task == "ON") bg-success @elseif ($recipe->task == "OFF") bg-warning @endif">
                <div class="card-header text-center mt-2 ml-2" style="letter-spacing: 0.42rem;">
                <!-- ナビタブ -->
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active bg-light border-light">レシピの概要</a>
                    </li>
                    <!-- レシピ詳細リンク -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{$recipe->url}}" target="_blank" rel="noopener noreferrer">詳細</a>
                    </li>
                    <!-- レシピ編集リンク -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('recipe/edit', ['id'=>$recipe->id]) }}">編集</a>
                    </li>
                    <!-- タスクオン・オフボタン -->
                    @if ($recipe->task == "OFF")
                    <li class="nav-item">
                        <form method="POST" action="{{ url('recipe/taskOn', ['id'=>$recipe->id]) }}">
                        {{ csrf_field()}}
                        <button type="submit" class="btn p-1 mt-1 ml-2 text-light" onclick='return confirm("「{{str_replace("\r\n", '', $recipe->name)}}」を調理タスクへ追加しますか？");'>
                            後で作る！</button>
                        </form>
                    </li>
                    @elseif ($recipe->task == "ON")
                    <li class="nav-item">
                        <form method="POST" action="{{ url('recipe/taskOff', ['id'=>$recipe->id]) }}">
                        {{ csrf_field()}}
                        <button type="submit" class="btn p-1 mt-1 ml-2 text-light" onclick='return confirm("「{{str_replace("\r\n", '', $recipe->name)}}」を調理タスクから削除しますか？");'>
                            作るのやめ！</button>
                        </form>
                    </li>
                    @endif
                </ul>
                </div>
                <div class="card-body bg-light p-4">
                    <div class="card-tool h5">
                    <!-- 使用食材一覧 -->
                    @foreach ($recipe->foods as $food)
                        <a type="button" href="{{ url('recipe/food', ['food'=>$food->name]) }}" class="btn btn-sm mr-2 btn-outline-@if ($recipe->task == "ON")success @elseif ($recipe->task == "OFF")warning @endif"
                        target="_blank" rel="noopener noreferrer">
                            {!! nl2br(htmlspecialchars($food->name)) !!}</a>
                    @endforeach
                    </div>
                    <!-- レシピネーム -->
                    <p class="card-text font-weight-bold mt-3 h3 @if ($recipe->task == "ON") text-success @elseif ($recipe->task == "OFF") text-warning @endif"
                        style="letter-spacing: 0.42rem;">{!! nl2br(htmlspecialchars($recipe->name)) !!}</p>
                    <!-- レシピコメント -->
                    <p class="card-text p-3 h5 @if ($recipe->task == "ON") bg-success @elseif ($recipe->task == "OFF") bg-warning @endif">{!! nl2br(htmlspecialchars($recipe->comment)) !!}</p>
                </div>
                <div class="card-footer">
                    <div class="text-left mb-2" style="letter-spacing: 0.22rem;">調理日</div>
                    <!-- レシピ作成日一覧 -->
                    <div class="h5">
                    @isset ($recipe->days)
                        @foreach ($recipe->days()->orderBy('dayname', 'desc')->get() as $day)
                        <span class="badge badge-pill badge-light mr-2">{{ $day->dayname }}</span>
                        @endforeach
                    @endisset
                    @if ($recipe->days->isEmpty())
                        <span class="badge badge-pill badge-light">まだ作ったことないよ！</span>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
