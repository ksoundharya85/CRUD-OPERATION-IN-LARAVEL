<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-color: #d2f2fa;">

    <div class="container mt-5">
        <h2>Student List</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Add Member</a>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-bordered " style="background-color:#f5f9fa;">
        <thead class="table-secondary">
            <tr>
                <th class="text-center align-middle">id</th>
                <th class="text-center align-middle">Name</th>
                <th class="text-center align-middle">Email</th>
                <th class="text-center align-middle">Gender</th>
                <th class="text-center align-middle">Country</th>
                <th class="text-center align-middle">Mobile Number</th>
                <th class="text-center align-middle">Class</th>
                <th class="text-center align-middle">Hobbies</th>
                <th class="text-center align-middle">Feedback</th>
                <th class="text-center align-middle">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td class="text-center align-middle">{{ $student->studentid }}</td>
                <td class="text-center align-middle">{{ $student->studentname }}</td>
                <td class="text-center align-middle">{{ $student->studentemail }}</td>
                <td class="text-center align-middle">{{ $student->studentgender }}</td>
                <td class="text-center align-middle">{{ $student->studentcountry }}</td>
                <td class="text-center align-middle">{{ $student->studentmobilenumber }}</td>
                <td class="text-center align-middle">{{ $student->studentclass }}</td>
                <td class="text-center align-middle">{{ $student->studenthobbies }}</td>
                <td class="text-center align-middle">{{ $student->studentfeedback }}</td>
                <td class="text-center align-middle" style="background-color: #ffffffe7;">
                    <a href="/editstudent/{{ $student->studentid }}" class="btn btn-warning" style="width: 80px; display: inline-block; text-align: center;">Edit</a>
                    <br><br>
                    <form action="{{ route('deletestudent', $student->studentid) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 80px;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
