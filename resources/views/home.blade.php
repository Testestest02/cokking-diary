@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>本サイトについて</h1>
@stop

@section('content')
    <p>夫婦でレシピ情報を共有することができます。</p>
    <p>レシピ一覧：レシピの閲覧・追加・編集・削除ができます。調理タスクの追加・削除もできます。</p>
    <p>調理タスク一覧：レシピ一覧から追加したタスクの閲覧、タスク消化ができます。</p>
    <p>調理日記一覧：いつ、誰が何を調理したかの一覧を閲覧できます。</p>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

