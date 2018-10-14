@extends('common.base')

@section('body')
    <form action="/gists" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleFormControlTextarea1">テキストエリアの例</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" name="action" value="send">送信</button>
    </form>
@endsection