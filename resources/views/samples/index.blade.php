@extends('layouts.default')

@section('title', $title)

@section('content')
    <h1>地図の表示サンプル</h1>
    <div id="map_box"></div>
    <script>
        function init(){
            //吉祥寺の位置情報を定義
            var kichijoji = {
              lat: 35.702969,
              lng: 139.579765
            };
            //mapを表示
            var map = new google.maps.Map(
              map_box,
              {
                center: kichijoji,
                zoom: 17,
                disableDefaultUI: true,
                zoomControl: true,
                clickableIcons: false,
              });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
@endsection