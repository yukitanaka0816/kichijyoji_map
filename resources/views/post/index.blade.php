@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
<script type="text/javascript">

var map;

// 初期化。bodyのonloadでinit()を指定することで呼び出してます
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
  map = new google.maps.Map(document.getElementById("map"), opts);

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

<form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>場所名：<input type="text" name="name" class="name_field" placeholder="入力必須"></label>
    </div>
    {{--<div>
        <label>営業時間：<input type="text" name="business_hours"></label>
    </div>--}}
    <div>
        <label>店舗情報：<input type="text" name="information" class="name_field"></label>
    </div>
    <div>
        <label>画像：<input type="file" name="image"></label>
    </div>
    <div>
        <label>住所：<input type="" name="image"></label>
    </div>
    <input type="hidden" name="status" value="0">
    <div>
        <input type="submit" value="投稿">
    </div>
</form>

@endsection