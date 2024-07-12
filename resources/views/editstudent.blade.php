<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Student</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #d2f2fa;">
    <div class="container mt-5 rounded" style="background-color:#f5f9fa;">
        <br>
        <h2>Edit Student</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('updatestudent', ['studentid' => $student->studentid]) }}" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="studentname" value="{{ old('studentname', $student->studentname) }}" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="studentemail" value="{{ old('studentemail', $student->studentemail) }}" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studentgender" id="male" value="Male" {{ old('studentgender', $student->studentgender) == 'Male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studentgender" id="female" value="Female" {{ old('studentgender', $student->studentgender) == 'Female' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="studentgender" id="other" value="Other" {{ old('studentgender', $student->studentgender) == 'Other' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <select id="country-dropdown" name="studentcountry" class="form-control" required>
                    <option value="">Select your country</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hobbies</label><br>
                @php
                $storedHobbies = explode(',', $student->studenthobbies);
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_reading" value="Reading" {{ (in_array('Reading', old('studenthobbies[]', $storedHobbies))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_reading">Reading</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_traveling" value="Traveling" {{ (in_array('Traveling', old('studenthobbies', $storedHobbies))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_traveling">Traveling</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_sports" value="Sports" {{ (in_array('Sports', old('studenthobbies', $storedHobbies))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_sports">Sports</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_music" value="Music" {{ (in_array('Music', old('studenthobbies', $storedHobbies))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_music">Music</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_gaming" value="Gaming" {{ (in_array('Gaming', old('studenthobbies', $storedHobbies))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_gaming">Gaming</label>
                </div>

                <div id="hobbies-error" class="invalid-feedback" style="display: none;">Please select at least one hobby.</div>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="studentmobilenumber" value="{{ old('studentmobilenumber', $student->studentmobilenumber) }}" placeholder="Enter your mobile number" required>
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control" id="class" name="studentclass" value="{{ old('studentclass', $student->studentclass) }}" placeholder="Enter your class" required>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea class="form-control" id="feedback" name="studentfeedback" rows="3" placeholder="Enter your feedback" required>{{ old('studentfeedback', $student->studentfeedback) }}</textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Update">
        </form>
        <br>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(countries => {
                const dropdown = document.getElementById('country-dropdown');
                countries.sort((a, b) => a.name.common.localeCompare(b.name.common));
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.cca2;
                    option.textContent = country.name.common;
                    dropdown.appendChild(option);
                });
                dropdown.value = '{{ old('studentcountry', $student->studentcountry) }}';
            })
            .catch(error => console.error('Error fetching countries:', error));

        function validateForm() {
            const hobbies = document.querySelectorAll('input[name="studenthobbies[]"]');
            let hobbyChecked = false;
            hobbies.forEach(hobby => {
                if (hobby.checked) {
                    hobbyChecked = true;
                }
            });

            if (!hobbyChecked) {
                document.getElementById('hobbies-error').style.display = 'block';
                return false;
            } else {
                document.getElementById('hobbies-error').style.display = 'none';
                return true;
            }
        }
    </script>
</body>
</html>
