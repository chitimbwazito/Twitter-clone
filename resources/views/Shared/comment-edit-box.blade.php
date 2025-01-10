<div class="card-body">
            <form action="{{ route('ideas.comments.update', [$idea->id, $comment->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3"> {{ $comment->content }} </textarea>
                </div>
                <button class="fs-6 fw-light text-muted">UPDATE</button>
</div>
