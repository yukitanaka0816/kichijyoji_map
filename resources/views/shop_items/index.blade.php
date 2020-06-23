@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div id="map_box"></div>
    
    
    
    
    
    <script>
      function init(){
        
        //吉祥寺の位置情報を定義
        var kichijoji = {
          lat: 35.702969,
          lng: 139.579765
        };
                
        
        // var shop_items = '{{ $shop_items }}';
        // console.log(shop_items);
        
        // var shop_items_json = '{{ $shop_items_json }}';
        // console.log(shop_items_json);
        
        // var shop_items_json = JSON.parse('{{ $shop_items_json }}');
        // console.log(shop_items_json);
        
        // var shop_item_name = shop_items[1]["name"];
        // console.log(shop_item_name);
        
        var shop_items = @json($shop_items);
        console.log(shop_items);
        
        console.log(shop_items[0]["name"]);
      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
@endsection