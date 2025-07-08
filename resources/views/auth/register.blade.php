<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
     <div class="container">
        <div class="card">
            <h3>User Registration</h3>
             @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="fname">First Name : </label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Your First Name ">
                </div>
                <div>
                    <label for="lname">Last Name : </label>
                    <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name ">
                </div>
                <div>
                    <label for="mobile">Mobile No : </label>
                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number">
                </div>
                <div>
                    <label for="address">Address : </label>
                    <input type="text" name="address" id="address" placeholder="Enter Your Address">
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input type="email" id="email" name="email" placeholder="Enter Email Address">
                </div>
                <div>
                   <label for="password">Password : </label>
                   <input type="password" name="password" id="password" placeholder="Enter Password">
               </div>
                <div>
                    <label for="cpassword">Confirm Password : </label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Enter Confirm Email">
                </div>
                <button type="submit">Register</button>
                <p>Alredy Have an Account ? </p> <a href="{{ route('login.form') }}">Login Here</a>
            </form>
        </div>
    </div>
    
</body>
</html>