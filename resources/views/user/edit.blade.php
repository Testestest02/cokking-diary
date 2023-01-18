@extends('adminlte::page')

@section('title', 'レシピ登録編集')

@section('content_header')
    <h1>レシピ編集</h1>
@stop

@section('content')
    <!-- エラーメッセージ -->
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
                <!-- アカウント編集フォーム -->
                <form method="POST" action="{{ route('myAccount.update', $user->id) }}" id="update">
                    @csrf
                    <div class="card-body">
                        <!-- 名前 -->
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" value="{{ old('name', $user->name) }}" id="name" name="name">
                        </div>
                        <!-- Eメールアドレス -->
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" value="{{ old('email', $user->email) }}" id="email" name="email">
                        </div>
                    </div>
                </form>
                    <!-- ボタングループ -->
                    <div class="card-footer">
                        <!-- アカウント編集登録ボタン -->
                        <button type="submit" class="btn btn-primary mr-3" id="edit-user-{{ $user->id }}" form="update">
                            登録
                        </button>
                        <!-- アカウント削除ボタン -->
                        <button type="submit" class="btn btn-danger" id="delete-user-{{ $user->id }}" form="delete" onclick='return confirm("「{{ $user->name }}様」のアカウントを削除してもよろしいですか");'>
                        アカウント削除
                        </button>
                    </div>
                <!-- アカウント削除フォーム -->
                <form method="POST" action="{{ route('myAccount.destroy', $user->id) }}" id="delete">
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
