@extends('layouts.logged_in')

@section('title', $title)

@section('style')
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
<script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('api.api_key')}}&callback=init" async defer></script>
<script type="text/javascript">
    //<![CDATA[

    var map;
    
    // 初期化。bodyのonloadでinit()を指定することで呼び出し
    function init() {

      // Google Mapで利用する初期設定用の変数
      var latlng = new google.maps.LatLng(35.702969, 139.579765);
      var opts = {
        zoom: 15,
        center: latlng,
        disableDefaultUI: true,
        zoomControl: true,
        clickableIcons: false,
      };

      // getElementById("map")の"map"は、body内の<div id="map">より
      map = new google.maps.Map(document.getElementById("map_box"), opts);

      google.maps.event.addListener(map, 'click', mylistener);
      
        
        // ジオコーダーの生成
        var geocoder = new google.maps.Geocoder();
        document.getElementById('search')
        .addEventListener(
        'click',
        function(){
              geocoder.geocode(
                // 第一引数にジオコーディングのオプションを設定
                {
                  address: document.getElementById('address').value
                },
                // 第二引数に結果取得時の動作を設定
                function(results, status){
                  // 失敗時の処理
                  if(status !== 'OK'){
                    alert('ジオコーディングに失敗しました。結果: ' + status);
                    return;
                  }
                  // 成功した場合、resultsの0番目に結果が取得される。
                  if(!results[0]){
                    alert('結果が取得できませんでした');
                    return;
                  }
                  // マップの中心を移動
                  //スクロールする
                  map.panTo(results[0].geometry.location);
                  
                //formatted_address 書式が整えられた住所の情報
                  document.getElementById('search_result').innerHTML = results[0].formatted_address;
                }
              );
            }
          );
          
          
          // クリック位置をリバースジオコーディング
            map.addListener('click', function(e){
              geocoder.geocode({
                location: e.latLng
              }, function(results, status){
                if(status !== 'OK'){
                  alert('リバースジオコーディングに失敗しました。結果: ' + status);
                  return;
                }
            
                // console.log(results);
                if(!results[0]){
                  alert('結果が取得できませんでした。');
                  return;
                }
            
                // クリックした位置にマーカーを立てる
                    var added_marker = new google.maps.Marker({
                      position: e.latLng, // クリックした箇所
                      map: map,
                      animation: google.maps.Animation.BOUNCE,
                      title: results[0].formatted_address
                    });
               
                
                
                //document.getElementById('searched_address').value = results[0].formated...
                //マーカークリックでマーカー、緯度経度削除
                added_marker.addListener('click', function(e){
                    this.setMap(null);
                    document.getElementById("show_lat").innerHTML = null;
                    document.getElementById("show_lng").innerHTML = null;
                    document.getElementById("show_lat").value = null;
                    document.getElementById("show_lng").value = null;
                });
              })
            });

    }

    function mylistener(event) {
      document.getElementById("show_lat").innerHTML = event.latLng.lat();
      document.getElementById("show_lng").innerHTML = event.latLng.lng();
      document.getElementById("lat").value = event.latLng.lat();
      document.getElementById("lng").value = event.latLng.lng();
      console.log(show_lat);
    }
</script>

<body onload="init()">
  <div class="container">
        <div class="col-lg-7 col-sm-12"></div>
            <div id="post">
            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
              @csrf
              <p>場所名：<input type="text" name="name" class="name_field" placeholder="20文字以内・入力必須"></p>
              <p>店舗情報：<input type="text" name="information" rows="5" cols="40" placeholder="200文字以内・入力必須"></p>
              <p>画像：<input type="file" name="image"></p>
              <p>カテゴリー（複数選択可）：
                <input type="checkbox" name="categories[]" value="1">食べる
                <input type="checkbox" name="categories[]" value="2">祝う
                <input type="checkbox" name="categories[]" value="3">買う
                <input type="checkbox" name="categories[]" value="4">遊ぶ
                <input type="checkbox" name="categories[]" value="5">休む
              </p>
            </div>
            <table>
                <tr><th>緯度</th><td id="show_lat"></td></tr>
                <tr><th>経度</th><td id="show_lng"></td></tr>
            </table>
              <div>
                  {{--<input type="hidden" name="shop_id" value="{{$shop_item->id}}">--}}
                  <input type="hidden" name="status" value="0">
                  <input type="hidden" name="lat" id="lat" value="">
                  <input type="hidden" name="lng" id="lng" value="">
                  <input type="submit" value="スポット登録">
              </div>
            </form>
    <div>
        <p>検索or地図をクリックして場所を指定</p>
        <label>住所：<input type="text" id="address" placeholder="場所名や住所"></label>
        <button id="search">検索</button>
        <p id="search_result"></p>
    </div>
    <div id="map_box"></div>
</body>
@endsection