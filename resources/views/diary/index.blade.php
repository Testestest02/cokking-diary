@extends('adminlte::page')

@section('title', '調理日記一覧')

@section('content_header')
<div class="d-flex mt-2">
    <h2>調理日記</h2>
    <a href="{{ url('diary/add') }}" class="ml-auto"><button type="submit" class="btn btn-secondary">
    調理日記追加</button></a>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>作成日</th>
                                <th>レシピ名</th>
                                <th>作成者</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $day)
                            <tr>
                                <td>{{ $day->dayname }}</td>
                                <td>{{ $day->recipe->name }}</td>
                                <td>{{ $day->user->name }}</td>
                                <td>
                                <form method="POST" action="{{ url('diary/destroy', ['id'=>$day->id]) }}">
                                {{ csrf_field()}}
                                {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick='return confirm("{{ $day->dayname }}に「{{str_replace("\r\n", '', $day->recipe->name)}}」を調理した記録を削除しますか？");'>
                                        削除
                                    </button>
                                </form>
                                </td>   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
