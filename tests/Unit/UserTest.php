<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = ['cat', 'pussy'];
        $this->assertTrue($data[0]=='cat');
        $this->assertFalse($data[0]== 'pussy');
    }

    public function testIndex() 
    {    
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
