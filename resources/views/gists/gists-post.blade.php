@extends('common.base')

@section('body')
<form action="/gists" method="post">
{{ csrf_field() }}
<button type="submit" name="action" value="send">送信</button>
</form>
@endsection