@extends('layout')

<title>ログイン</title>

@section('content')

<div class="container">
  <section class="section">
    <div class="column is-4 is-offset-4">
      <h1 class="title is-2 has-text-centered has-text-grey">ログイン</h1>
      @if($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      {!! Form::open(['url' => '/login']) !!}
        <div class="box">
          <div class="field">
            <label for='label'>
              メールアドレス :
            </label>
            <p class="control">
              {!! Form::email('email', old('email'), ['class' => 'input is-medium']) !!}
            </p>
          </div>
          <div class="field">
            <label for='label'>
              パスワード :
            </label>
            <p class="control">
              {!! Form::password('password', ['class' => 'input is-medium']) !!}
            </p>
          </div>
          <br>
          <div class="field">
            <p class="control" style="width:100%">
              {!! Form::submit('ログイン', ['class' => 'button is-primary is-medium', 'style' => 'width:100%']) !!}
            </p>
          </div>

          <div>
            {!! link_to("users/create", 'ユーザー登録') !!}<br />
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </section>
</div>

@endsection