@extends('common.base')
@section('title')
    title sub
@endsection
@section('body')
    <div class="border alert alert-secondary">

        @for($i = 0; $i < count($name); $i++)
            <div class="shadow m-3 p-3 border bg-light">
                <p>アカウント名：{{$name[$i]}}</p>
                <a href="{{$owner_html_url[$i]}}"><img class="rounded-circle" style="width: 70px; height: 70px" src="{{$img[$i]}}" alt="avatar"></a>
                <a href="{{$html_url[$i]}}"><p>{{key($files[$i])}}</p></a>
                <p>Gistの説明：{{$description[$i]}}</p>
                <p>{{$updated_at[$i]}}</p>
            </div>
        @endfor

    </div>
@endsection
