@if (Auth::id() == $user->id)
    {!! Form::open(['route' => 'posts.store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
            {!! Form::text('country', null, ['placeholder' => 'type country']) !!}
            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::file('image', ['enctype'=>'multipart/form-data']) !!}
        </div>
    {!! Form::close() !!}
@endif