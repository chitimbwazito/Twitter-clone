<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <link href="https://bootswatch.com/5/quartz/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    @include('layout.navigation')
    <div class="container py-4">
        @if(session('success'))

        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="row">
            @include('shared.success-message')
            @include('shared.left-sidebar')
            <div class="col-6">
                @include('shared.share-idea')
                @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('shared.idea-card')
                </div>
                @empty
                <div><p> no results found</p></div>
                @endforelse
                <div class="mt=3">
                {{ $ideas->withQueryString()->links() }}
                </div>
                <hr>
            </div>
            <div class="col-3">
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
