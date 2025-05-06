<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <h1>Ini Halaman Login</h1>
        <span>Silahkan masuk dengan username dan password</span>
    
        <form method="POST" action="{{url('login')}}">
            @csrf
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
            </div>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>

        @if (Session::has('pesan'))
            <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                {{ Session::get('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
</body>
</html>