@extends('layouts.logged_in')

@section('style')
<link rel="stylesheet" href="{{ asset('css/wants.css') }}">
@endsection

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div class="row">
            <div class="col-lg-7 col-sm-12">
                <h4>行きたいところリスト</h4>
                <table>
                    <tr>
                        <th>場所名</th>
                        <th>順序</th>
                    </tr>
                    <div class="wants">
                    @forelse($wants as $want)
                    
                        <tr>
                            <td>{{ $want->shop->name}}</td>
                            <td>
                                <select name="order[]" form="order_form">
                                  @for($i = 1; $i <= count($wants); $i++)
                                    <option value="{{ $i }}" @if( $want->order === $i ) selected @endif >{{ $i }}</option>
                                  @endfor
                                </select>
                            </td>
                            <form method="post" action="{{ route('wants.destroy', $want) }}">
                                @csrf
                                @method('delete')
                                <td><input type="submit" value="削除"></td>
                                <input type="hidden" value="{{ $want->id }}">
                            </form>
                        </tr>
                    @empty
                        <tr>行きたいところを追加していません！</tr>
                    @endforelse
                    </div>
                </table>
                <form method="post" id="order_form" action="{{ route('wants.update') }}">
                    @csrf
                    @method('patch')
                    <p><input type="submit" value="順序を変更する"></p>
                </form>
{{--            
                <!--<p>現在選択されている順序</p>-->
                <!--<ul id="root_list">-->
                <!--    <li>井の頭公園</li>-->
                <!--    <li>ハンモックカフェ</li>-->
                <!--    <li>ジブリ美術館</li>-->
                <!--</ul>-->
                <!--<p><input type="submit" value="ルートを作成する"></p>-->
--}}
                <div id="map_box"></div>
                
            </div>
            <div class="col-lg-5 col-sm-12" id="detail_box">
                <h4>---詳細情報---</h4>
                @forelse($wants as $want)
                <label class="info_spot_name">【{{ $want->shop->name }}】</label>
                <div class="row">
                    <div class="col-6"><img class="info_img" src="{{ asset('/img/kichijoji_spot_img/') }}/{{ $want->shop->image }}"></div>
                    <div class="col-6">
                      <ul class="info_list">
                          <li>営業時間：{{ $want->shop->business_hours }}</li>
                          <li>詳細情報：{{ $want->shop->information }}</li>
                          <li>ウェブサイト：<a href="{{ $want->shop->url }}">{{ $want->shop->url }}</a></li>
                          <li><a href="{{ route('comments', $want->shop->id )}}">口コミ一覧</a></li>
                      </ul>
                    </div>
                </div>
                @empty
                <div>行きたいところを追加しよう</div>
                @endforelse
            </div>
        </div>
        
    <script>
      function init(){
        var wants = @json($wants);
        var place_list = [];
        for(let i = 0; i < wants.length; i++){
          place_list.push(wants[i]["shop"]);
        }
        var map_box = document.getElementById('map_box');
        var map = new google.maps.Map(
          map_box,
          {
            center: new google.maps.LatLng(place_list[0]["lat"],place_list[0]["lng"]),
            zoom: 15,
            disableDefaultUI: true,
            zoomControl: true,
            clickableIcons: false,
          }
        );
        var display_buttons = Array.from(document.getElementsByClassName('display'));
        //各ボタンにイベントを設定
        display_buttons.forEach(
          function(display_button){
            display_button.addEventListener(
              'click',
              function(){
                map.panTo(new google.maps.LatLng(display_button.dataset.lat,display_button.dataset.lng)); // スムーズに移動
              }
            );
          }
        );
       
        if(place_list.length === 1){
          var marker = new google.maps.Marker({
              position: new google.maps.LatLng(place_list[0]["lat"],place_list[0]["lng"]), // クリックした箇所
              map: map,
              animation: google.maps.Animation.DROP
            });
        }else if(place_list.length === 2){
          var request = {
            origin: new google.maps.LatLng(place_list[0]["lat"],place_list[0]["lng"]),
            destination: new google.maps.LatLng(place_list[place_list.length - 1]["lat"],place_list[place_list.length - 1]["lng"]),
            travelMode: google.maps.DirectionsTravelMode.WALKING, // 交通手段(歩行。DRIVINGの場合は車)
          };
          var d = new google.maps.DirectionsService(); // ルート検索オブジェクト
          var r = new google.maps.DirectionsRenderer({ // ルート描画オブジェクト
                  map: map, // 描画先の地図
                  preserveViewport: true, // 描画後に中心点をずらさない
                  })
          d.route(request, function(result, status){
              // OKの場合ルート描画
              if (status == google.maps.DirectionsStatus.OK) {
                  r.setDirections(result);
              }
          }); 
        }else if(place_list.length > 2){
          var waypoints = []
          for(var i = 1; i < (place_list.length - 1); i++){  
            waypoints.push({ location: new google.maps.LatLng(place_list[i]["lat"],place_list[i]["lng"])})
            }
        var request = {
          origin: new google.maps.LatLng(place_list[0]["lat"],place_list[0]["lng"]),
          destination: new google.maps.LatLng(place_list[place_list.length - 1]["lat"],place_list[place_list.length - 1]["lng"]),
          waypoints: waypoints,
          travelMode: google.maps.DirectionsTravelMode.WALKING, // 交通手段(歩行。DRIVINGの場合は車)
          };
          var d = new google.maps.DirectionsService(); // ルート検索オブジェクト
          var r = new google.maps.DirectionsRenderer({ // ルート描画オブジェクト
                  map: map, // 描画先の地図
                  preserveViewport: true, // 描画後に中心点をずらさない
                  })
          d.route(request, function(result, status){
              // OKの場合ルート描画
              if (status == google.maps.DirectionsStatus.OK) {
                  r.setDirections(result);
              }
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>

@endsection