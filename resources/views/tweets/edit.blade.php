<!DOCTYPE html>

<html>

<head>
    <title>Edit Tweet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    @if (session('successStatus'))
        <div class="alert alert-success" role="alert">
            {{ session('successStatus') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @foreach ($tweets as $tweet)
    <form action="/tweets/{{$tweet->id}}" method="post">
        {{csrf_field() }}
        <div class="form-group"></div>
        <label for="tweet"></label>

        <textarea class="form-control" name="tweet" id="tweet" rows="2" value="{{ $tweet->tweet }}">{{ $tweet->tweet }}</textarea>
        @endforeach
            <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>

</html>