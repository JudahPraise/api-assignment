<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function index()
    {
        // $students = Student::all();
        $students = json_decode(Http::get('https://intechtestapi.herokuapp.com/api/getStudents')->body(),true);
        return view('welcome', compact('students'));
    }

    public function store(Request $request)
    {
        // Student::create(
        //     $request->all()
        // );

        // return redirect(route('student.index'))->with('success', sprintf("%s added to database", $response['name']));
        $response = Http::post('https://intechtestapi.herokuapp.com/api/addNewStudent', $request->all())->body();
        $response = json_decode($response, true);

        return redirect(route('student.index'))->with('success', sprintf("%s added to database via API.", $response['name']));
    }

    public function update(Request $request, $id){
        
        $student = [
            'id' => $id,
            'name' => $request->name,
            'grade' => $request->grade
        ];

        $response = Http::put('https://intechtestapi.herokuapp.com/api/updateStudent', $student);
        return redirect(route('student.index'))->with('success', sprintf("%s successfully updated via API.", $response['name']));

    }

    public function delete($id){

        $studentId = ['id' => $id]; 

        $response = Http::delete('https://intechtestapi.herokuapp.com/api/deleteStudent', $studentId)->body();
        $response = json_decode($response, true);

        // return redirect(route('student.index'))->with('success', sprintf("%s %s", $response['record'][0]['name'], $response['message']));
        return redirect(route('student.index'))->with('delete', sprintf("%s", $response['message']));
    }
}
