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
        
        //店舗情報をjs形式で定義
        var shop_items = @json($shop_items);
        
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
        
        //店舗の数だけマーカーを立てる
        var markers = [];
        for (var i = 0; i < shop_items.length; i++) {
          
          //id,nameを定義
          var shop_name = shop_items[i]["name"];
          var shop_id = shop_items[i]["id"];
          
          //マーカーを立てる
          let marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"])
          });
          
          let infoWindow = new google.maps.InfoWindow({
            content: postForm(shop_items[i])
          });
          
          //マーカーにイベントを追加
          marker.addListener('click', function(){
            infoWindow.open(map,marker);
          });
          
          //マーカーを配列にpushして代入
          markers.push(marker);
        }
        
        //postForm ajaxじゃない版
        // function postForm(shop_item) {
          
        //   //要素を作成
        //   var form = document.createElement('form');
        //   var request = document.createElement('input');
        //   var token = document.createElement('input');
        //   var div = document.createElement('div');
        //   var p_name = document.createElement('p');
        //   var p_ours = document.createElement('p');
          
        //   //p要素の中身を定義
        //   p_name.innerHTML = shop_item['name'];
        //   p_ours.innerHTML = shop_item['business_ours'];
          
        //   //メソッド、パスを指定
        //   form.method = 'POST';
        //   form.action = '/shop_items/' + shop_item['id'];
          
        //   //タイプ、バリューを指定
        //   request.type = 'submit';
        //   request.value = '詳細';
        //   token.type = 'hidden';
        //   token.name = '_token';
        //   token.value = '{{ csrf_token() }}';
        
          
        //   //要素に要素を追加
        //   form.appendChild(request);
        //   div.appendChild(p_name);
        //   div.appendChild(p_ours);
        //   div.appendChild(form);
          
        //   //作成したdivboxをinfoWindowのcontent内に追加
        //   return div;
        // }
        
        //postForm ajax版
        function postForm(shop_item) {
          
          //divboxを生成
          var div = document.createElement('div');
          //ボタンを生成
          var button = document.createElement('button');
          //テキストを生成
          var p_name = document.createElement('p');
          var p_hours = document.createElement('p');
          //innnerHTMLを設定
          p_name = 
          
          //ボタンのテキストを定義
          button.innerHTML = '詳細';
          //ボタンのidを定義
          button.id = 'box';
          
          //divにそれぞれの要素を追加
          div.appendChild(p_name);
          div.appendChild(p_hours);
          div.appendChild(button);
          
          return div;
        }
        
      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
@endsection