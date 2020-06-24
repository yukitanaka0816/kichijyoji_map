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
    
    <a href="{{ url('/admin/shop_items') }}">お店一覧ページ</a>
    <a href="{{ url('/admin/inquiries') }}">お問い合わせ一覧ページ</a>
    <table>
        <tr>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>登録日時</th>
            <th>操作</th>
        </tr>
        <ul>
            @forelse($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                    <form method="post" action="{{ url('/admin/users/'. $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <td>
                            <input type="submit" value="削除">
                        </td>
                    </form>
                </tr>
            @empty
                <li>ユーザは登録されていません</li>
            @endforelse
        </ul>
    </table>
@endsection