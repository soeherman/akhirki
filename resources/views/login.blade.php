<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row mt-4 justify-content-md-center">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p>Silahkan masuk dengan username dan password</p>
                        </div>
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
                
                        @include('message.message')
                    </div>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>