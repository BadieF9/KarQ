<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<body>
    <h2>Registration Form</h2>

    @if($errors)
        <ul>
            @foreach($errors->all() as $error)

                <li>{{$error}}</li>

            @endforeach
        </ul>
    @endif

    <form action="/register" method="post">
        @csrf
       <div>
           <label for="name">name: </label>
           <input type="text" name="name">
       </div>
        <div>
            <label for="email">email: </label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="password">password: </label>
            <input type="text" name="password">
        </div>
        <div>
            <label for="password">confirm password: </label>
            <input type="text" name="password_confirmation">
        </div>
        <button>send</button>


    </form>




</body>
</html>
