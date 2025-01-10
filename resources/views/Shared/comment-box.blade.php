<div>
    @auth
        <div class="mb-3">
            <form action="{{ route('ideas.comments.store', $idea->id) }}" method="POST">
                @csrf
                <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
                <div>
                    <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
            </form>
        </div>
    </div>
@endauth
<hr>
@foreach ($idea->comments as $comment)
    <div class="d-flex align-items-start">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}"
            alt="Luigi Avatar">
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <h6 class="">{{ $comment->user->name }}
                </h6>
                <small class="fs-6 fw-light text-muted">{{ $comment->created_at->diffforhumans() }}</small>
                @can('comment.delete', $comment)
                <a href="{{route('ideas.comments.edit', [$idea->id, $comment->id])}}">EDIT</a>
                <Form action="{{route('ideas.comments.delete', [$idea->id, $comment->id])}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger fs-6 fw-light text-muted">DELETE</button>
                </Form>

                @endcan
            </div>
            <p class="fs-6 mt-3 fw-light"> {{ $comment->content }}
            </p>
        </div>
    </div>
@endforeach
</div>
{{-- <div class="card-body">
    @if ($editingComment ?? false)
        @foreach ($idea->comments as $comment)
            <div class="d-flex align-items-start">
                <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}"
                    alt="Luigi Avatar">
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="">{{ $comment->user->name }}
                        </h6>
                        <small class="fs-6 fw-light text-muted">{{ $comment->created_at->diffforhumans() }}</small>
                        @can('comment.edit', $comment)
                            <a href="{{ route('ideas.comments.edit', [$idea->id, $comment->id]) }}"
                                class="fs-6 fw-light text-muted">EDIT</a>
                        @endcan
                    </div>

                    <textarea name="content" class="form-control" id="content" rows="3"> {{ $comment->content }} </textarea>
                </div>
                </p>
            </div>
</div>
@endforeach
@endif --}}
{{-- <form action="{{ route('ideas.comments.update', [$idea->id, $comment->id]) }}" method="POST">
    @csrf
    @method('put')
    <div class="mb-3">
        <textarea name="content" class="form-control" id="content" rows="3"> {{ $comment->content }} </textarea>
    </div>
    <button class="fs-6 fw-light text-muted">UPDATE</button>
    @endif
    </div> --}}
