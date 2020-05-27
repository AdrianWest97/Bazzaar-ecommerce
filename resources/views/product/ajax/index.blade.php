
    @foreach ($products as $prod)
            @include('layouts.product',['item'=>$prod,'show'=>false])
    @endforeach
    
