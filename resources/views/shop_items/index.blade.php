@extends(($login_user === TRUE)?'layouts.logged_in':'layouts.not_logged_in')
@section('style')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('title', $title)

@section('content')
    <div class="article">
        <h5>行きたいスポットをジャンルから検索できます♪</h5>
        <div class="row" id="top-row">
          <div class="col-2">
            <a href="{{ url('/shop_items/1') }}"><img class="cat_img img-fluid" src="{{ asset('img/category_eat.jpg') }}"></a>
          </div>
          <div class="col-2">
            <a href="{{ url('/shop_items/2') }}"><img class="cat_img img-fluid" src="{{ asset('img/category_celebrate.jpg') }}"></a>
          </div>
          <div class="col-2">
            <a href="{{ url('/shop_items/3') }}"><img class="cat_img img-fluid" src="{{ asset('img/category_buy.jpg') }}"></a>
          </div>
          <div class="col-2">
            <a href="{{ url('/shop_items/4') }}"><img class="cat_img img-fluid" src="{{ asset('img/category_enjoy.jpg') }}"></a>
          </div>
          <div class="col-2">
            <a href="{{ url('/shop_items/5') }}"><img class="cat_img img-fluid" src="{{ asset('img/category_rest.jpg') }}"></a>
          </div>
        </div>
        
        <div class="row">
            <div class="col-lg-7 col-sm-12">
                   <div id="map_box"></div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <h4>---詳細情報---</h4>
                <div id="side">
                  <div id="shop_name"></div>
                  <div id="business_hours"></div>
                  <div id="shop_item_info"></div>
                  <div><a id="url" href=""></a></div>
                  <div><img id="shop_image" src="{{ asset('img/details_box.png') }}"></div>
                </div>
                <p><img class="ad_img" src="{{ asset('img/ad_c_team.jpg') }}"></p>
                <p><a a href="{{ route('post.index') }}"><img id="bannar_to_post" src="{{ asset('img/bannar_to_post.jpg') }}"></a></p>
            </div>
        </div>
      </div>

      @if( $login_user === TRUE )
        @forelse($wants as $want)
          <p>{{ $want->shop->name }}</p>
        @empty
          <p>行きたいところがありません</p>
        @endforelse
      @endif
    

    <script>

      /* global $ */
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
            zoom: 14,
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
          var shop_category = shop_items[i]['category_id'];
          
          //マーカーを立てる
          if(shop_category === 1){
            let marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"]),
              icon: '../../img/map_icon/eat_small.png',
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
           
          }else if(shop_category === 2){
            let marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"]),
              icon: '../../img/map_icon/celebrate_small.png',
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
           
          }else if(shop_category === 3){
            let marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"]),
              icon: '../../img/map_icon/buy_small.png',
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
           
          }else if(shop_category === 4){
            let marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"]),
              icon: '../../img/map_icon/enjoy_small.png',
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
           
          }if(shop_category === 5){
            let marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(shop_items[i]["lat"],shop_items[i]["lng"]),
              icon: '../../img/map_icon/rest_small.png',
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
              type: 'GET',
              data: {'shop_id': $(this).data('shop_item_id')},
            })
            //ajaxリクエスト成功時の処理
            .done(function(data){
              //laravel内で処理された結果($shop_item_info)がdataに入って返ってくる
              $('#shop_name').text(data['shop_item_info'][0]['name']);
              $('#business_hours').text(data['shop_item_info'][0]['business_hours']);
              $('#shop_item_info').text(data['shop_item_info'][0]['information']);
              $('#url').text(data['shop_item_info'][0]['url']);
              $('#shop_image').attr('src', '{{ asset('/img/kichijoji_spot_img/') }}' + '/' + data['shop_item_info'][0]['image'] );
              $('#url').attr('href', data['shop_item_info'][0]['url']);
              //commentを生成
              for (var i = 0; i < data['comments'].length; i++) {
                //divboxを生成
                $('<div>', {
                  id: 'comment' + i,
                }).appendTo('#side');
                
                //divboxのtextを追加
                $('#comment' + i).text(data['comments'][i]['comments']);
              }
              
            })
            //ajaxリクエスト失敗時の処理
            .fail(function(data){
              alert('ajaxリクエスト失敗');
            });
          });
          
          add_button.innerHTML = '行きたい！';
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
          
          
          comment_button.innerHTML = 'コメント';
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