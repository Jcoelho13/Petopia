@section('content')
    <h1>FAQ</h1>
    <p>Here are some frequently asked questions:</p>
        @php
            $faqs = \App\Models\FAQ::all();
        @endphp
        @foreach($faqs as $faq)
                <div class="question">
                    <p>{{ $faq->question }}</p>
                    <div class="menu" onclick="toggleFaq({{ $faq->id }})">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="hidden answer" id="{{'faq' . $faq->id . 'answer'}}">
                    <p>{{ $faq->answer }}</p>
                </div>
        @endforeach
@endsection

@if(Auth::user() && Auth::user()->isAdmin())
    @include('layouts.admin_app')
@else
    @include('layouts.app')
@endif