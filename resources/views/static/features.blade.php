@section('content')

    <div class="text">
        <h1>Features</h1>
        <p>Here are some of the key features of Petopia Store:</p>
        <ul>
            <li><strong>US Number</strong> - <strong>US Name</strong> | US Priority | US Description.</li>
            @php
                $userStories = \App\Models\UserStory::all();
            @endphp
            @foreach($userStories as $userStory)
                <li>
                    <strong>{{ $userStory->number }}</strong> -
                    <strong>{{ $userStory->name }}</strong> |
                    {{ $userStory->priority }} |
                    {{ $userStory->description }}
                </li>
            @endforeach
        </ul>
    </div>

@endsection

@if(Auth::user() && Auth::user()->isAdmin())
    @include('layouts.admin_app')
@else
    @include('layouts.app')
@endif