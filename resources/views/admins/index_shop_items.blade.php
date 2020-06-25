@extends('layouts.default')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト">
        </form>
    </div>
    <ul>
        <li><a href="{{ url('/admin/inquiries') }}">お問い合わせ一覧ページ</a></li>
        <li><a href="{{ url('/admin/users') }}">ユーザー一覧ページ</a></li>
    </ul>
    <table>
        <tr>
            <th>店舗名</th>
            <th>写真</th>
            <th>店舗情報</th>
            <th>営業時間</th>
            <th>URL</th>
            <th>公開フラグ</th>
            <th>更新日時</th>
        </tr>
        <ul>
            @forelse($shop_items as $shop_item)
                <tr>
                    <td>
                        {{ $shop_item->name }}
                    </td>
                    <td>
                        {{ $shop_item->image }}
                    </td>
                    <td>
                        {{ $shop_item->information }}
                    </td>
                    
                    <form method="post" action="{{ url('/admin/shop_items/'. $shop_item->id) }}">
                        @csrf
                        @method('PATCH')
                        <td>
                            <textarea name="update_bussiness_hours" class="bussiness_hours_field" placeholder="営業時間を入力"></textarea>
                            <input type="hidden" name="status" value="{{ $shop_item->status }}">
                            <input type="hidden" name="url" value="{{ $shop_item->url }}">
                            <input type="submit" value="変更">
                        </td>
                    </form>
                    
                    <form method="post" action="{{ url('/admin/shop_items/'. $shop_item->id) }}">
                        @csrf
                        @method('PATCH')
                        <td>
                            <textarea name="update_url" class="url_field" placeholder="URLを入力"></textarea>
                            <input type="hidden" name="status" value="{{ $shop_item->status }}">
                            <input type="hidden" name="bussiness_hours" value="{{ $shop_item->bussiness_hours }}">
                            <input type="submit" value="変更">
                        </td>
                    </form>
                    
                    <form method="post" action="{{ url('/admin/shop_items/'. $shop_item->id) }}">
                        @csrf
                        @method('PATCH')
                        @if( $shop_item->status === 1)
                        <td>
                            <input type="submit" value="公開 → 非公開">
                            <input type="hidden" name="update_status" value=0>
                        </td>
                        @endif
                        
                        @if( $shop_item->status === 0)
                        <td>
                            <input type="submit" value="非公開 → 公開">
                            <input type="hidden" name="update_status" value=1>
                        </td>
                        @endif
                    </form>
                    
                    <td>
                        ({{ $shop_item->updated_at }})
                    </td>
                </tr>
            @empty
                <li>お店がありません</li>
            @endforelse
        </ul>
    </table>
@endsection