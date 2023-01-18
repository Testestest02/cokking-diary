@extends('adminlte::page')

@section('title', '調理タスク一覧')

@section('content_header')
<div class="d-flex mt-2">
    <h2>調理タスク（{{$recipes->count()}}件）</h2>
    <!-- タスクリセットボタン -->
    <form method="POST" action="{{ url('task/taskAllOff') }}" class="ml-auto">
    {{ csrf_field()}}
        <button type="submit" class="btn btn-success" 
        onclick='return confirm("調理タスクを全て消去しますか？");'>
            タスクリセット</button>
    </form>
</div>
@stop

@section('content')
<div class="p-4">
    <div class="row mb-3">
        @foreach ($recipes as $recipe)
        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-lg-0 p-4">
            <!-- レシピタスクカード -->
            <div class="card bg-success">
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
                    <!-- タスク消化ボタン -->
                    <li class="nav-item">
                        <form method="POST" action="{{ url('task/taskEnd', ['id'=>$recipe->id]) }}">
                        {{ csrf_field()}}
                            <button type="submit" class="btn p-1 mt-1 ml-2 text-light" 
                            onclick='return confirm("{{date('Y/m/d')}}に「{{str_replace("\r\n", '', $recipe->name)}}」の調理タスクを消化しましたか？");'>
                                調理済み！</button>
                        </form>
                    </li>
                </ul>
                </div>
                <div class="card-body bg-light p-4">
                    <div class="card-tool h5">
                    <!-- 使用食材一覧 -->
                    @foreach ($recipe->foods as $food)
                        <button type="button" class="btn btn-sm mr-2 btn-outline-success">
                            {!! nl2br(htmlspecialchars($food->name)) !!}</button>
                    @endforeach
                    </div>
                    <!-- レシピネーム -->
                    <p class="card-text font-weight-bold mt-3 h3 @if ($recipe->task == "ON") text-success @elseif ($recipe->task == "OFF") text-warning @endif"
                        style="letter-spacing: 0.32rem;">{!! nl2br(htmlspecialchars($recipe->name)) !!}</p>
                    <!-- レシピコメント -->
                    <p class="card-text p-3 h5 @if ($recipe->task == "ON") bg-success @elseif ($recipe->task == "OFF") bg-warning @endif">{!! nl2br(htmlspecialchars($recipe->comment)) !!}</p>
                </div>
                <div class="card-footer">
                    <div class="text-left mb-2" style="letter-spacing: 0.22rem;">調理日</div>
                    <!-- レシピ作成日一覧 -->
                    <div class="h5">
                    @isset ($recipe->days)
                        @foreach ($recipe->days()->orderBy('dayname', 'asc')->get() as $day)
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
