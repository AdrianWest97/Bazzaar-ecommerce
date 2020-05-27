@component('mail::message')

<p>The following items were requested by <b>{{$data['name']}}</b>

<h1>{{$data['item']['item']['title']}}</h1>
<ul style="list-style-type: none">
    <li>Quantity {{$data['item']['qty']}}</li>
    <li>Price ${{$data['item']['price']}}</li>
    <li>Total ${{$data['item']['item']['total']}}</li>
</ul>

<img src="{{$data['item']['item']->getimage("thumbnail")}}" style="max-width: 300px" />

<hr>
User info
<ul style="list-style-type: none">
    <ul style="list-style-type: none">
<li>Name: <b>{{$data['name']}}</b></li>
<li>Email: <a href="mailto:">{{$data['email']}}</a></li>
<li>Phone: <a href="http://" target="_blank" rel="noopener noreferrer">{{$data['phone']}}</a></li>
    </ul>

@component('mail::button', ['url' => ''])
Goto store
@endcomponent

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
