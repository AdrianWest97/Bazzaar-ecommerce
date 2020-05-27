

@component('mail::message')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
        @endcomponent
    @endslot


# {{$data['subject']}}
<div class="avatar" style="isplay: inline-block;
position: relative;
width: 3rem;
height: 3rem;
text-align: center;
border: #dee2e6;
border-radius: 50%;
background: #fff;
box-shadow: 0 0 1rem rgba(0,0,0,0.15);
line-height: 3rem;">
    <img src="{{$data['photo']}}" style="" class="avatar-sm"/>
</div>
{{$data['message']}}

@component('mail::button', ['url' => config('app.url')])
Go bazzaar
@endcomponent

 {{-- Footer --}}
 @slot('footer')
 @component('mail::footer')
   footer
 @endcomponent
@endslot
@endcomponent
