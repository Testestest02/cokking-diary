@extends('adminlte::page')

@section('title', 'レシピ登録')

@section('content_header')
    <h1>レシピ登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">レシピ名</label>
                            <textarea class="form-control" id="name" name="name" placeholder="レシピ名" wrap="hard">{{ old('name') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="url">レシピURL</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" placeholder="レシピのリンク">
                        </div>

                        <div class="form-group">
                            <label for="comment">コメント</label>
                            <textarea class="form-control" id="comment" name="comment" placeholder="コメント" wrap="hard">{{ old('comment') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="foods" class="text-md-right">使用食材</label>
                            <div>
                                <select multiple class="form-control" id="foods" name="foods[]">
                                    @foreach ($foods as $food)
                                    <option value="{{ $food->id }}" {{ is_array(old("foods")) && in_array("$food->id", old("foods"), true)? ' selected' : '' }}>{{ $food->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
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
