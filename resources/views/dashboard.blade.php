<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Details Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #d2f2fa;">
    <div class="container mt-5 rounded"style="background-color:#f5f9fa;">
        <br>
        <h2>Student Form</h2>
        <form method="post" action="{{ route('studentlist') }}" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control {{ $errors->has('studentname') ? 'is-invalid' : '' }}" id="name" name="studentname" placeholder="Enter your name" value="{{ old('studentname') }}" required>
                @if ($errors->has('studentname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('studentname') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control {{ $errors->has('studentemail') ? 'is-invalid' : '' }}" id="email" name="studentemail" placeholder="Enter your email" value="{{ old('studentemail') }}" required>
                @if ($errors->has('studentemail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('studentemail') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->has('studentgender') ? 'is-invalid' : '' }}" type="radio" name="studentgender" id="male" value="Male" {{ old('studentgender') == 'Male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->has('studentgender') ? 'is-invalid' : '' }}" type="radio" name="studentgender" id="female" value="Female" {{ old('studentgender') == 'Female' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->has('studentgender') ? 'is-invalid' : '' }}" type="radio" name="studentgender" id="other" value="Other" {{ old('studentgender') == 'Other' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
                @if ($errors->has('studentgender'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('studentgender') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="country-dropdown">Country</label>
                <select class="form-control" id="country-dropdown" name="studentcountry" required>
                    <option value="">Select your country</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hobbies</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_reading" value="Reading" {{ (is_array(old('studenthobbies')) && in_array('Reading', old('studenthobbies'))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_reading">Reading</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_traveling" value="Traveling" {{ (is_array(old('studenthobbies')) && in_array('Traveling', old('studenthobbies'))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_traveling">Traveling</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_sports" value="Sports" {{ (is_array(old('studenthobbies')) && in_array('Sports', old('studenthobbies'))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_sports">Sports</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_music" value="Music" {{ (is_array(old('studenthobbies')) && in_array('Music', old('studenthobbies'))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_music">Music</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenthobbies[]" id="hobby_gaming" value="Gaming" {{ (is_array(old('studenthobbies')) && in_array('Gaming', old('studenthobbies'))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_gaming">Gaming</label>
                </div>
                <div id="hobbies-error" class="invalid-feedback" style="display: none;">Please select at least one hobby.</div>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" class="form-control {{ $errors->has('studentmobilenumber') ? 'is-invalid' : '' }}" id="mobile" name="studentmobilenumber" placeholder="Enter your mobile number" value="{{ old('studentmobilenumber') }}" required>
                @if ($errors->has('studentmobilenumber'))
                    <div class="invalid-feedback">
                        {{ $errors->first('studentmobilenumber') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control {{ $errors->has('studentclass') ? 'is-invalid' : '' }}" id="class" name="studentclass" placeholder="Enter your class" value="{{ old('studentclass') }}" required>
                @if ($errors->has('studentclass'))
                    <div class="invalid-feedback">
                        {{ $errors->first('studentclass') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea class="form-control" id="feedback" name="studentfeedback" rows="3" placeholder="Enter your feedback" required>{{ old('studentfeedback') }}</textarea>
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
        <br>
    </div>

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
