<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class studentcontroller extends Controller
{
    //

    public function index(Request $request){
        

        $fields = [];
        $students = students::query();

        if ($request->get('search')) {
            $students->where('firstname', 'like', "{$request->get('search')}%")
            ->orWhere('lastname', 'like', "{$request->get('search')}%");
        }

        if ($request->get('limit')){
            $students->limit($request->get('limit'));
        }

        if ($request->get('offset')){
            $students ->offset($request->get('offset'))->limit(PHP_INT_MAX);
        }

        if($request->get('sex')){
            $students->where('sex', $request->get('sex'));
        }

        if($request->get('course')){
            $students->where('course', $request->get('course'));
        }

        if($request->get('year')){
            $students->where('year', $request->get('year'));
        }

        if ($request->get('sort') && $request->get('direction')) {
            $students->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
        }

        return response()->json([$fields ? $students->get($fields) : $students->get(), 'greetings'=>'Welcome']);

        
    }

    public function select($id){
            try {
                return response()->json(students::findORFail($id));
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Not found'], 404);
            }
           
    }

    public function students($id){
        $students = students::query()->where('id', '=', $id);
        return response()->json($students->get());
    }

    public function create(Request $request){
        $newStudent = students::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'sex' => $request->sex,
            'address' => $request->address,
            'year' => $request->year,
            'course' => $request->course,
            'section' => $request->section
        ]);
        $student = students::query();
        return response()->json([$student->where('id', '=', $newStudent->id)->get(), 'message'=>'Posting'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $student = students::query()->where('id', '=', $id);
        $student -> update($request->all());
        return response()->json([$student->get(), 'message'=>'Patch Test'], Response::HTTP_OK);
    }

    public function delete ($id){
        $student = students::findOrFail($id);
        $student->delete();
        return response()->json($student);
    }
}
