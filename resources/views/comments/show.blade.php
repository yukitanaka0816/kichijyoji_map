@extends('layouts.logged_in')

@section('title', $title)

@section('style')
<link rel="stylesheet" href="{{ secure_asset('css/comment.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7 col-sm-12">
            <h4>【{{$shop_item->name}}の口コミ一覧】</h4>
            {{--<p>基本情報</p>
            <p>店舗名：{{$shop_item->name}}</p>
            <p>営業時間：{{$shop_item->business_hours}}</p>
            <img src="{{ asset('storage/photos/' . $shop_item->image) }}">--}}
            <div>
            <ul class="review_list">
                @forelse($reviews as $review)
                <li>○{{$review->user->name}}<br>
                    {{$review->comments}}<br>
                    {{$review->created_at}}<br>
                    @if($review->image !== '')
                    <img class="review_img" src="{{ asset('storage/photos/' . $review->image) }}">
                    @endif
                </li>
                @empty
                <li>この場所の口コミはありません</li>
                @endforelse
            </ul>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12">
            <form method="post" action="{{ route('comments.store', $shop_item->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="shop_id" value="{{$shop_item->id}}">
                <p>お名前：{{Auth::user()->name}}</p>
                <p>口コミ：<input type="text" id="comment" name="comments" class="comment_field" placeholder="500文字以内で入力"></p>
                <p>画像 (内装・外装・商品・景色など)：<input type="file" name="image"></p>
                <input type="submit" value="口コミを投稿する">
            </form>
        </div>
    </div>

@endsection
    