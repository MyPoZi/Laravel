<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
{{--@foreach($name as $recode)--}}
{{--<p>{{$recode}}</p>--}}
{{--@endforeach--}}
@for($i = 0; $i < count($name); $i++)
    <p>{{$name[$i]}}</p>
    <a href="{{$owner_html_url[$i]}}"><img style="width: 40px; height: 40px" src="{{$img[$i]}}"></a>
    <a href="{{$html_url[$i]}}">{{$files[$i]}}</a>
    <p>{{$updated_at[$i]}}</p>
@endfor
</body>
</html>