<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>Login Form</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Email : </label>
                    <input type="email" name="email" placeholder="Enter Email">
                </div>
                 <div>
                    <label for="email">Password : </label>
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <button type="submit">Login</button>
                <p>Don't Have Account ? </p> <a href="{{ route('register.form') }}">Register Here</a>
            </form>
        </div>
    </div>
</body>
</html>