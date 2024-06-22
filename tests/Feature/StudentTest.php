<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_students(){
        $response = $this->get('/api/students');
        $response -> assertStatus(Response::HTTP_OK);
        $response -> assertJsonPath('greetings', 'Welcome');
    }

    public function test_post_student(){
        $response = $this->post('/api/students',[
            'firstname' => 'Reima',
            'lastname' => 'Lei',
            'birthdate' => '2003-02-24',
            'sex' => '21',
            'address' => 'Carigara',
            'year' => '3',
            'course' => 'BSIT',
            'section' => 'A'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Posting');
    }

    public function test_patch_student(){
        $response = $this->patch('/api/students/1',[
            'firstname' => 'Reima',
            'lastname' => 'Lei',
            'birthdate' => '2003-02-24',
            'sex' => '21',
            'address' => 'Carigara',
            'year' => '3',
            'course' => 'BSIT',
            'section' => 'A'
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['message']);
        $response->assertJsonPath('message', 'Patch Test');
    }
}
