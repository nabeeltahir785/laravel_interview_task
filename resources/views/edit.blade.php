<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Edit User</title>
</head>
<body>
<div class="container-fluid">
    <div class="col-12 my-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('user.update',$user->id)}}" method="post">
            @method('patch')
            @csrf
            <h1 class="text-center">Update User</h1>


            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="title" value="{{$user->title}}" name="title">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="first" value="{{$user->first}}" name="first">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="last" value="{{$user->last}}" name="last">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="email" value="{{$user->email}}" disabled>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="street" value="{{$user->street}}" name="street">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="city" value="{{$user->city}}" name="city">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="state" value="{{$user->state}}" name="state">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="country" value="{{$user->country}}" name="country">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="passcode" value="{{$user->passcode}}" name="passcode">
            </div>
            <input type="submit" class="btn btn-primary btn-sm">
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


</body>
</html>
