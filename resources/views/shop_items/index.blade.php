@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div id="map_box"></div>
    
    
    
    
    
    <script>
      function init(){
        var shinagawa = {
          lat: 35.6284477,
          lng: 139.7366322
        };
        var map_box = document.getElementById('map_box');
        var map = new google.maps.Map(
          map_box, // 第１引数はマップ表示対象の要素。
          {
            // 第２引数で各種オプションを設定
            center: shinagawa, // 地図の中心を品川に
            zoom: 15, // 拡大のレベルを15に。（1 - 18くらい）
            disableDefaultUI: true, // 各種UIをOFFに
            zoomControl: true, // 拡大縮小だけできるように
            clickableIcons: false, // クリック関連の機能をoffに。
          }
        )
      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
@endsection