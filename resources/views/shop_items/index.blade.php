@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <div id="map_box"></div>
    <div>
      <div id="shop_item_info"></div>
      <div id="comments"></div>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
    <script>
      //最初に読み込み
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
            content: infoContent(shop_items[i])
          });

          
          //マーカーにイベントを追加
          marker.addListener('click', function(){
            infoWindow.open(map,marker);
          });
          
          //マーカーを配列にpushして代入
          markers.push(marker);
        }

        
        //detailButton
        function infoContent(shop_item) {
          //divboxを生成
          var div = document.createElement('div');
          //ボタンを生成
          var detail_button = document.createElement('button');
          var add_button = document.createElement('button');
          var comment_button = document.createElement('button');
          //テキストを生成
          var p_name = document.createElement('p');
          var p_hours = document.createElement('p');
          
          //innnerHTMLを設定
          p_name.innerHTML = shop_item['name'];
          p_hours.innerHTML = shop_item['business_hours'];
          
          //ボタンのテキストを定義
          detail_button.innerHTML = '詳細';
          detail_button.className = 'detail';
          detail_button.dataset.shop_item_id = shop_item['id'];
          
          //detail_buttonに処理を追加
          $(detail_button).on('click', function(){
            //ajaxでリクエストを送信
            $.ajax({
              url: '/shop_items/show/' + $(this).data('shop_item_id'),
              type: 'POST',
              data: {'shop_id': $(this).data('shop_item_id')},
            })
            //ajaxリクエスト成功時の処理
            .done(function(data){
              //laravel内で処理された結果($shop_item_info)がdataに入って返ってくる
              $('#shop_item_info').text(data['shop_item_info']);
              $('#comments').text(data['comments']);
            })
            //ajaxリクエスト失敗時の処理
            .fail(function(data){
              alert('ajaxリクエスト失敗');
            });
          });
          
          add_button.innerHTML = 'ルートに追加';
          add_button.className = 'add_wants';
          add_button.dataset.shop_item_id = shop_item['id'];
          
          //add_buttonに処理を追加
          $(add_button).on('click', function(){
            //ajaxでリクエストを送信
            $.ajax({
              url: '/shop_items/wants/' + $(this).data('shop_item_id'),
              type: 'POST',
              data: {'shop_id': $(this).data('shop_item_id')},
            })
            //ajaxリクエスト成功時の処理
            .done(function(data){
              //laravel内で処理された結果がdataに入って返ってくる
              alert(data);
            })
            //ajaxリクエスト失敗時の処理
            .fail(function(data){
              console.log(data);
              alert('ajaxリクエスト失敗');
            });
          });
          
          
          comment_button.innerHTML = 'コメントを追加';
          comment_button.className = 'add_comment';
          comment_button.dataset.shop_item_id = shop_item['id'];
          
          //comment_buttonに処理を追加
        $(comment_button).on('click', function(){
          window.location.href = '/comments/' + $(this).data('shop_item_id');
        });
          
          //divにそれぞれの要素を追加
          div.appendChild(p_name);
          div.appendChild(p_hours);
          div.appendChild(detail_button);
          div.appendChild(comment_button);
          div.appendChild(add_button);
          
          return div;
        }
      }
      
      //csrfトークンの埋め込み
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('const.google-map.apikey') }}&callback=init" async defer></script>
@endsection