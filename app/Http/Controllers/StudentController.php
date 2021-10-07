<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index()
    {
        $students = Student::all();
        return view('backend.admin.students.list', compact('students'));
    }

    function create()
    {
        return view('backend.admin.students.add');
    }
}
