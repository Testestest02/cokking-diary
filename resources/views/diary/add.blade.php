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
                            <label for="recipes">レシピ名</label>
                            <div>
                                <select class="form-control" id="recipes" name="recipe_id">
                                    @foreach ($recipes as $recipe)
                                    <option value="{{ $recipe->id }}" {{ is_array(old("recipes")) && in_array("$recipe->id", old("recipes"), true)? ' selected' : '' }}>{{ $recipe->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="days">作成日</label>
                            <div>
                                <input type="date" name="dayname" />
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
