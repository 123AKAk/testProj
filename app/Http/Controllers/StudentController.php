<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Fetch all students
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    // Insert a new student
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:Students',
            'password' => 'required|min:6',
            'age' => 'required|integer',
            'department' => 'required|string',
        ]);

        $student = Student::create([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'department' => $request->department,
        ]);

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student,
        ], 201);
    }

    // Fetch a single student by ID
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student, 200);
    }

    // Search students by middleName or email
    public function search(Request $request)
    {
        $query = Student::query();

        if ($request->has('firstName')) {
            $query->where('firstName', 'like', '%' . $request->firstName . '%');
        }

        if ($request->has('lastName')) {
            $query->where('lastName', 'like', '%' . $request->lastName . '%');
        }

        if ($request->has('middleName')) {
            $query->where('middleName', 'like', '%' . $request->middleName . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->has('studentId')) {
            $query->where('studentId', 'like', '%' . $request->studentId . '%');
        }

        $students = $query->get();

        if ($students->isEmpty()) {
            return response()->json(['message' => 'No student found'], 404);
        }

        return response()->json($students, 200);
    }

}
