@can('users.edit', $user)
<div class="card">
    <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src="{{ $user->getImageURL() }}" alt="{{$user->name}}">
                <div>
                    <p>Name:</p>
                    <h3 class="card-title mb-0"><input class="form control" name="name" type="text"></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="px-2 mt-4">
            <label for="image">Profile Picture:
            </label>
            <input name="image" class="mt-3" type="file">
            <h5 class="mt-3 fs-5"> Bio : </h5>
            <div class="mb-3">
                <textarea name="bio" class="form-control" id="bio" rows="3"></textarea>
            </div>
            <button class="mt-4 btn btn-success" type="submit">Save</button>
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> 0 Followers </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->Ideas->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->Comments->count() }} </a>
            </div>
        </div>
        </form>
    </div>
@endcan

