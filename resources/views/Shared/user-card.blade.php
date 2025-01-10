<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="{{ $user->name }}">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                    @auth
                        @can('users.edit', $user)
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endcan
                    @endauth
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
            <p class="fs-6 fw-light">{{ $user->bio }}</p>
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{ $user->followers->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="far fa-user me-1">
                    </span> {{ $user->following->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->Ideas->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->Comments->count() }} </a>
            </div>
            @auth
                @if (Auth::id() !== $user->id)
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                            <form action="{{ route('unfollow', $user->id) }}" method="post">
                                @csrf
                                <div class="mt-3">
                                    <button class="btn btn-danger btn-sm"> Unfollow </button>
                                </div>
                            @else
                                <form action="{{ route('follow', $user->id) }}" method="post">
                                    @csrf
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-sm"> Follow </button>
                                    </div>
                        @endif
                    </div>
                @endif
                </form>
            @endauth
        </div>
    </div>
