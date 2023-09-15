@extends('layout')

<title>ホーム</title>

@section('content')
<div class="container">
  <section class="section">
    <div class="column is-8 is-offset-2">
      @if (session('success'))
        <div class="notification is-success">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="notification is-danger">
          {{ session('error') }}
        </div>
      @endif
      @foreach($messages as $message)
        <div class="box media">
          <figure class="media-left">
            <i class="fas fa-clipboard-list"></i>
          </figure>
          <div class="media-content">
            <div class="content">
              <p>
                <strong>{{ $message->title }}</strong>
              </p>
              <p>
                {{ $message->text }}
              </p>
              <p class="content-option-space">
                {{ $message->user->name }} / {{ $message->created_at }}
              </p>

              @if ($message->user_id === Auth::user()->id)
                  {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                      <button type="submit" class="button is-danger is-small">削除</button>
                  {!! Form::close() !!}
              @endif
            </div>
          </div>
        </div>
        @foreach($message->comments as $comment)
        <div class="column is-8 is-offset-4">
          <div class="box media">
            <figure class="media-left">
              <i class="fas fa-grin-beam"></i>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  {{ $comment->text }}
                </p>
                <p class="content-option-space">
                  {{ $comment->user->name }} / {{ $comment->created_at }}
                </p>
                @if ($comment->user_id === Auth::user()->id)
                  {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
                    <button type="submit" class="button is-danger is-small">削除</button>
                  {!! Form::close() !!}
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
        {!! Form::open(['url' => '/comments']) !!}
          {!! Form::hidden('message_id', $message->id) !!}
          <div class="column is-6 is-offset-6">
            <div class="field">
              <label for='label'>
                コメント :
              </label>
              <p class="control">
                {!! Form::textarea('text', null, ['class' => 'input is-medium', 'style' => 'height: 100px;']) !!}
              </p>
            </div>
            <div class="field">
              <p class="control" style="text-align: right;">
                {!! Form::submit('コメント投稿', ['class' => 'button is-primary is-medium']) !!}
              </p>
            </div>
          </div>
        {!! Form::close() !!}
      @endforeach
    </div>
  </section>
</div>
@endsection