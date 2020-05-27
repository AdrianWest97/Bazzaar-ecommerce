@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center m-2">
            <div class="col-12 col-lg-10 m-5 p-2">
                <h1 class="h3">About</h1>
                <p>Bazzaar is an online market place that allows producers, 
                    retailers and consumers to communicate, interact and transact. 
                    We see where a lot of small businesses are leaving a lot of profits 
                    on the table due to not having enough exposure in the market place or
                     simply by just not having an online presence. Bazzaar aims to make this 
                     process easier and more accessible for the common man. Our aim is to create 
                     a centralized market place where commerce takes place.</p>
            </div>
            <div class="col-12 col-lg-10 m-5 p-2">
                <h1 class="h3">How to list products or create a post/ad</h1>
                <p>To list products users are required to have a professional account by creating a store. This can be done from the Account page.
                </p>
            </div>
            <div class="col-12 col-lg-10 m-5 p-2">
                <h1 class="h3">Benefits of having a Professional Account/ Creating a Store</h1>
                <p>Users who upgrade their accounts have access to additional tools such as:</p>
                <ul style="list-style-type: none" class="m-0 p-0">
                    <li class="p-2">A Personal Dashboard.</li>
                    <li class="p-2">Product Manager Tool where they are able to manage their inventory.</li>
                    <li class="p-2">Subscription Page where they are able to view customers who have subscribed to their store(s) and their feedback.</li>
                    <li class="p-2">Analytics Page where they are able to track the activities of viewers with their products for a more in-depth analysis.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection
