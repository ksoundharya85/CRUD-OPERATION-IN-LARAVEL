<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d2f2fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
        }
        .custom-container {
            background-color: #f5f9fa;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container custom-container">
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('submitlogin') }}">
            @csrf
            <div class="form-group">
                <label for="userid">User ID</label>
                <input type="text" class="form-control" id="userid" name="loginid" placeholder="Enter your User ID" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            @if(Session::has('success'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif

            <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
