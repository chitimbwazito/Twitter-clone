<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{$idea->user->getImageURL()}}"
                    alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}"> {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <form method="POST" action="{{ route('ideas.destroy', $idea->id) }}">
                @csrf
                @method('delete')
                <a href="{{ route('ideas.show', $idea->id) }}">View</a>
               @can('idea.edit', $idea)
                    <a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                    <button class="btn btn-danger btn-small">DELETE</button>
                @endcan
            </form>
        </div>
    </div>
    <div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3"> {{ $idea->content }} </textarea>
                </div>
                @error('content')
                    <span class="fs-6 text-danger"> {{ $message }}</span>
                @enderror
                <div class="">
                    <button type="submit" class="btn btn-dark"> Share </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->diffforhumans() }} </span>
            </div>
        </div>
        @include('shared.comment-edit-box')
    </div>
</div>
