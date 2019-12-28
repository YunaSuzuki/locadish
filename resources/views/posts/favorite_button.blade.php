@if (Auth::user()->is_favorite($post->id))
    {!! Form::open(['route' => ['posts.unfavorite', $post->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-primary btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['posts.favorite', $post->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-success btn-sm"]) !!}
    {!! Form::close() !!}
@endif