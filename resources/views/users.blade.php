<!Doctype html>
<html lang="en">
    <head>
        <title>Users Listing</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            body{
                height:800px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="users/export/" class="btn btn-primary my-3 float-right">Download CSV</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">title</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">email</th>
                            <th scope="col">city</th>
                            <th scope="col">street</th>
                            <th scope="col">state</th>
                            <th scope="col">country</th>
                            <th scope="col">passcode</th>
                        </tr>
                        </thead>
                        <tbody class="user_data">
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->title}}</td>
                                <td>{{$user->first}}</td>
                                <td>{{$user->last}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->city}}</td>
                                <td>{{$user->street}}</td>
                                <td>{{$user->state}}</td>
                                <td>{{$user->country}}</td>
                                <td>{{$user->passcode}}</td>
                                <td><a href="{{route('user.show',$user->id)}}" class="btn btn-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var pageNumber = 1;
            var limit = 5;
            var offset = 0;
            var isScroll = true;
            var lastScrollTop = 0;
            $(window).scroll(function(event){
                var st = $(this).scrollTop();
                if (st > lastScrollTop){
                    if(isScroll){
                        offset = pageNumber * limit;
                        pageNumber = pageNumber ++;
                        limit = limit * pageNumber;
                        isScroll = false;
                        $.ajax({
                            url:"/getUserData",
                            type:"post",
                            data:{"offset":offset,"pageNumber":pageNumber,"limit":limit},
                            success:function(response){
                                console.log(response);
                                let userData = "";
                                response.users.forEach((user)=>{
                                    userData += `<tr>
                                <td>${user.title}</td>
                                <td>${user.first}</td>
                                <td>${user.last}</td>
                                <td>${user.email}</td>
                                <td>${user.city}</td>
                                <td>${user.street}</td>
                                <td>${user.state}</td>
                                <td>${user.country}</td>
                                <td>${user.passcode}</td>
                                <td><a href="/user/${user.id}" class="btn btn-primary">Edit</a></td>
                            </tr>`
                                });
                                $("tbody").append(userData);
                                isScroll = true;

                            }

                        })
                    }

                }
                lastScrollTop = st;
            });


        </script>
    </body>
</html>
