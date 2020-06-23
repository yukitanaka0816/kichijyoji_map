@extends('layouts.default')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        @forelse($inquires as $inquire)
            <li>
                <div>
                    名前: {{ $inquire->name }}
                </div>
                <div>
                    メールアドレス: {{ $inquire->email }}
                </div>
                <div>
                    お問い合わせ内容: {{ $inquire->content }}
                </div>
                <div>
                    ({{ $inquire->created_at }})
                </div>
            </li>
        @empty
            <li>お問い合わせはありません</li>
        @endforelse
    </ul>
@endsection