
@foreach ($users as $user)
    <h1> {{$user['name'] }}</h1>
    <h1> {{$user['age']}}</h1>
@endforeach

@if ($user['age'] == 30)
<p>YOU CANT DRIVE</p>
@endif
