@extends('common.base')

@section('body')
    <div class="border alert alert-secondary">

        @for($i = 0; $i < count($name); $i++)
            <div class="shadow m-3 p-3 border bg-light">
                <p>{{$name[$i]}}</p>
                <a href="{{$owner_html_url[$i]}}"><img class="rounded-circle" style="width: 70px; height: 70px" src="{{$img[$i]}}"></a>
                <a href="{{$html_url[$i]}}"><p>{{key($files[$i])}}</p></a>
                <p>Description:{{$description[$i]}}</p>
                <p>{{$updated_at[$i]}}</p>
            </div>
        @endfor

    </div>
@endsection
