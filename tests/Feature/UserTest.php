<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_user(){
        $response = $this->get('/api/users');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'greeting',
            'message',
            'student'=>[
                'firstname',
                'lastname',
                'address'=>[
                    'city',
                    'municipality',
                    'street'
                ]
            ]
        ]);
        $response->assertJsonPath('greeting', 'Hello!');
        $response->assertJsonPath('student.firstname', 'morning seven');
        $response->assertJsonPath('student.lastname', 'strike land');
        $response->assertJsonPath('student.address.city', 'waray');
        $response->assertJsonPath('student.address.municipality', 'Carigara');
        $response->assertJsonPath('student.address.street', 'Brgy. Barugohay Norte');
    }
}
