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
    <a href="{{ url('/admin/inquiries') }}">お問い合わせ一覧ページ</a>
    <a href="{{ url('/admin/users') }}">ユーザー一覧ページ</a>
    <table>
        <tr>
            <th>店舗名</th>
            <th>写真</th>
            <th>公開フラグ</th>
            <th>登録日</th>
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
                        ({{ $shop_item->created_at }})
                    </td>
                </tr>
            @empty
                <li>お店がありません</li>
            @endforelse
        </ul>
    </table>
@endsection