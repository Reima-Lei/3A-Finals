<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Response;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_subjects(){
        $response = $this->get('/api/students/1/subjects');
        $response -> assertStatus(200);
        $response -> assertJsonPath('greetings', 'Get Test');
    }

    public function test_post_subjects(){
        $response = $this->post('/api/students/1/subjects',[
            'student_id' => 1,
            'subject_code' => 'IT1325',
            'name' => 'APPLICATION LIFECYCLE MANAGEMENT',
            'description' => 'This is your designated course',
            'instructor' => 'Cy Alonzo',
            'schedule' => 'FRI 1:30pm - 4:30pm',
            'prelims' => 1.25,
            'midterms' => 1.5,
            'prefinals' => 1.75,
            'finals' => 1.5,
            'date_taken' => '2024-06-22'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Post Test');
    }

    public function test_patch_subjects(){
        $response = $this->patch('/api/students/1/subjects/1',[
            'student_id' => 1,
            'subject_code' => 'IT1325',
            'name' => 'APPLICATION LIFECYCLE MANAGEMENT',
            'description' => 'This is your designated course',
            'instructor' => 'Cy Alonzo',
            'schedule' => 'FRI 1:30pm - 4:30pm',
            'prelims' => 1.25,
            'midterms' => 1.5,
            'prefinals' => 1.75,
            'finals' => 1.5,
            'date_taken' => '2024-06-22'
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Patch Test');
    }
}
