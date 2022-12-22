<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Validator;


class StudentController extends Controller
{
    //
    public function AddData(Request $req)
    {
        $rules = array(
            'name' => 'required|string',
            'email' => 'required|string',
            'department' => 'required|string',
            'section' => 'required|string',
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return $validator->errors();
        } else {
        $student = new Student();
        $student->name = $req->name;
        $student->email = $req->email;
        $student->department = $req->department;
        $student->section = $req->section;
        $result = $student->save();

        if ($result) {
            return "Success for Saved";
        } else {
            return "Not save";
        }
 
        }

   }

    public function updateData($id, Request $req)
    {
        $student = Student::findOrFail($id);
        $student->name = $req->name;
        $student->email = $req->email;
        $student->department = $req->department;
        $student->section = $req->section;
        $updated = $student->save();

        if ($updated) {
            return "Success for UpdateData";
        } else {
            return "Data isn't UpdateData";
        }
    }

    public function deleteData($id)
    {
        $student = Student::findOrFail($id);
        $deleted = $student->delete();
        if ($deleted) {
            return "data is deleted Success";
        } else {
            return "data isn't deleted";
        }
    }

    public function searchData($name)
    {
        $student = Student::where('name', 'like', '%' . $name . '%')->get();

        if (count($student) > 0) {
            return $student;
        } else {
            return ".$name.is not search from database";
        }
    }
    public function listDataId($id)
    {
        $allStudent = Student::all();
        $student = Student::findOrFail($id);
        if (!$student) {
            return $allStudent;
        } else {
            return $student;
        }
    }
}
