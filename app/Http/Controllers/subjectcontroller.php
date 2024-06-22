<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class subjectcontroller extends Controller
{
    //

    public function index(Request $request, $id){
        

        $fields = [];
        $subject = subject::query()->where('student_id', '=', $id);

        if ($request->get('search')) {
            $subject->where('name', 'like', "{$request->get('search')}%")
            ->orWhere('instructor', 'like', "{$request->get('search')}%");
        }

        if ($request->get('limit')){
            $subject->limit($request->get('limit'));
        }

        if ($request->get('offset')){
            $subject ->offset($request->get('offset'))->limit(PHP_INT_MAX);
        }

        if ($request->get('sort') && $request->get('direction')) {
            $subject->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
            $subject->select($fields);
        }

        return response()->json([$fields ? $subject->get($fields) : $subject->get(), 'greetings' => 'Get Test']);

        
    }

    // public function select($id, $subject_id){
    //         try {
    //             return response()->json(subject::findORFail($id, $subject_id));
    //         } catch (\Throwable $th) {
    //             return response()->json(['message' => 'Not found'], 404);
    //         }
           
    // }
    public function create(Request $request, $id){
        $newSubject = subject::create([
            'student_id' => $id,
            'subject_code' => $request->subject_code,
            'name' => $request->name,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'schedule' => $request->schedule,
            'prelims'=>$request->prelims,
            'midterms'=>$request->midterms,
            'prefinals'=>$request->prefinals,
            'finals'=>$request->finals,
            'date_taken'=>$request->date_taken,
        ]);

        $subject = subject::query();
        return response()->json([$subject->where('id', '=', $newSubject->id)->get(), 'message'=>'Post Test'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $subject = subject::query()->where('id', '=', $id);
        $subject->update($request->all());
        return response()->json([$subject->get(), 'message' => 'Patch Test']);
    }

    public function subject($id, $subject_id){
        $subject= subject::query()->where('student_id', '=', $id)->where('id', '=', $subject_id);
        return response()->json($subject->get());
    }

    // public function delete ($id){
    //     $subject = students::findOrFail($id);
    //     $subject->delete();
    //     return response()->json($subject);
    // }

}
