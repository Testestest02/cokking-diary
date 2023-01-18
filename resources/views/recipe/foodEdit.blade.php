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
            <form method="POST" action="{{ url('recipe/foodDestroy') }}" id="delete">
            {{ csrf_field()}}
            {{ method_field('DELETE') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="foods" class="text-md-right">食材名</label>
                        <div>
                            <select class="form-control" id="foods" name="foods[]">
                                @foreach ($foods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger" form="delete" onclick='return confirm("この食材情報を削除してもよろしいですか");'>削除</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
