<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Student;

class StudentController extends BaseController
{
    public function index() {
        $data = Student::all();

        return $this->sendResponse($data->toArray());
    }

    public function show($id) {
        $student = Student::find($id);

        if(!$student) {
            return $this->sendError('Student not found');
        }

        return $this->sendResponse($student->toArray());
    }
    
    public function create(Request $request) {
  
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::create([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'jurusan' => $jurusan
        ]);


        return $this->sendResponse($student->toArray(), 'Student is created successfully', 201);
    }   

    function update(Request $request, $id) {

        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;
        
        $student = Student::find($id);

        if(!$student) {
            return $this->sendError('Student not found');
        } 
        else {
            $student->update(
                [
                    'nama' => ($nama ? $nama : $student->nama),
                    'nim' => ($nim ? $nim : $student->nim),
                    'email' => ($email ? $email : $student->email),
                    'jurusan' => ($jurusan ? $jurusan : $student->jurusan)
                ]);

            return $this->sendResponse($student->toArray(), 'Student is updated successfully');
        }
        

    }

    function destroy($id) {
        $student = Student::find($id);

        if(!$student) {
            return $this->sendError('Student not found');
        } else {
            $student->delete();
        }

        return $this->sendResponse($student->toArray(), "Student on id $id is deleted!");
    }
}