<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\studentdata;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class studentformController extends Controller
{
    public function form(Request $request)
{
    $studentname = $request->input('studentname');
    $studentemail = $request->input('studentemail');
    $studentgender = $request->input('studentgender');
    $studentcountry = $request->input('studentcountry');
    $studentmobilenumber = $request->input('studentmobilenumber');
    $studentclass = $request->input('studentclass');
    $studenthobbies = $request->input('studenthobbies',[]);

    $studentfeedback = $request->input('studentfeedback');

    $request->validate([
        'studentname' => 'required|regex:/^[\pL\s]+$/u',
        'studentemail' => 'required|email|unique:studentdata,studentemail',
        'studentgender' => 'required',
        'studentmobilenumber' => 'required|digits:10',
        'studentclass' => [
            'required',
            Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']),
        ],
        'studenthobbies' => 'nullable|array',
        'studentfeedback' => 'nullable|string',
    ], [
        'studentname.required' => 'The name field is required.',
        'studentname.regex' => 'The name can only contain letters and spaces.',
        'studentemail.required' => 'The email field is required.',
        'studentemail.email' => 'The email must be a valid email address.',
        'studentemail.unique' => 'This email is already taken.',
        'studentgender.required' => 'The gender field is required.',
        'studentmobilenumber.required' => 'The mobile number field is required.',
        'studentmobilenumber.digits' => 'The mobile number must be exactly 10 digits.',
        'studentclass.required' => 'The class field is required.',
        'studentclass.in' => 'The class must be between 1 and 12.',
        'studenthobbies.array' => 'Invalid hobbies data.',
        'studentfeedback.string' => 'Invalid feedback data.',
    ]);

    $studenthobbies = implode(',', $request->input('studenthobbies', []));
    studentdata::create([
        "studentname" => $studentname,
        "studentemail" => $studentemail,
        "studentgender" => $studentgender,
        "studentcountry" => $studentcountry,
        "studenthobbies" => $studenthobbies,
        "studentmobilenumber" => $studentmobilenumber,
        "studentclass" => $studentclass,
        "studentfeedback" => $studentfeedback
    ]);
    Session::flash('success', 'Student '.$request->studentname.' added successfully');
    return redirect()->route('student.list');
}

    public function index() {
        $students = studentdata::all();
        return view('studentlist', compact('students'));
    }


    public function edit($studentid) {
        $student = studentdata::findOrFail($studentid);
        return view('editstudent', compact('student'));
    }
    public function update(Request $request, $studentid)
    {
        $request->validate([
            'studentname' => 'required|regex:/^[\pL\s]+$/u',
            'studentemail' => 'required',
            'studentgender' => 'required',
            'studentmobilenumber' => 'required|digits:10',
            'studentclass' => [
                'required',
                Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']),
            ],
            'studenthobbies' => 'nullable|array',
            'studentfeedback' => 'nullable|string',
        ], [
            'studentname.required' => 'The name field is required.',
            'studentname.regex' => 'The name can only contain letters and spaces.',
            'studentemail.required' => 'The email field is required.',
            'studentemail.email' => 'The email must be a valid email address.',
            'studentgender.required' => 'The gender field is required.',
            'studentmobilenumber.required' => 'The mobile number field is required.',
            'studentmobilenumber.digits' => 'The mobile number must be exactly 10 digits.',
            'studentclass.required' => 'The class field is required.',
            'studentclass.in' => 'The class must be between 1 and 12.',
            'studenthobbies.array' => 'Invalid hobbies data.',
            'studentfeedback.string' => 'Invalid feedback data.',
        ]);
        $studenthobbies = implode(',', $request->input('studenthobbies', []));
        $student = studentdata::findOrFail($studentid);


        $student->update([
            "studentname" => $request->studentname,
            "studentemail" => $request->studentemail,
            "studentgender" => $request->studentgender,
            "studentcountry" => $request->studentcountry,
            "studenthobbies" => $studenthobbies,
            "studentmobilenumber" => $request->studentmobilenumber,
            "studentclass" => $request->studentclass,
            "studentfeedback" => $request->studentfeedback,
        ]);
        Session::flash('success', 'Student '.$request->studentname.' details updated successfully');
        return redirect()->route('student.list');
    }

    public function studentpage(){
        $students = studentdata::all();
        return view('dashboard',compact('students'));
    }
    public function destroy(Request $request,$studentid)
{
    $student = studentdata::findOrFail($studentid);
    $student->delete();
    Session::flash('success', 'Student ID No:'.$request->studentid.' details deleted successfully');
    return redirect()->back();
}
}
