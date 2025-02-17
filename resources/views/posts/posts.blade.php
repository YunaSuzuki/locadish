<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($post->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">posted at {{ $post->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                    <p class="mb-0">{!! nl2br(e($post->country)) !!}</p>
                    <img src="{{ Storage::disk('s3')->url($post->image) }}" class="mb-0 image-size"></img>
                </div>
                <div>
                    <span class="row">
                        @if (Auth::id() == $post->user_id)
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        @include('posts.favorite_button')
                    </span>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $posts->links('pagination::bootstrap-4') }}