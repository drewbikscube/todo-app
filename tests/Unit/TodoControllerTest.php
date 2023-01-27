<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    public function testWebRoute_GET()
    {
        $response = $this->followingRedirects()->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Tasks');
    }

    public function testWebRoute_POST()
    {
        $response = $this->followingRedirects()->post('/', ['task' => 'Test task name']);
        $response->assertStatus(200);
        $response->assertSeeText('Test task name');
    }

    public function testWebRoute_UPDATE()
    {
        //Get latest entry
        $active = DB::table('todos')->where('status', 'active')->first();

        $response = $this->followingRedirects()->patch("/$active->id", ['status' => 'completed']);
        $response->assertStatus(200);
        
        //Assert entry status has changed
        $updated = DB::table('todos')->where('id', $active->id)->first();
        $this->assertEquals('completed', $updated->status);
    }

    public function testWebRoute_DELETE()
    {
        //Get latest entry
        $latest = DB::table('todos')->latest()->first();

        $response = $this->followingRedirects()->delete("/$latest->id");
        $response->assertStatus(200);
        
        //Assert entry id no longer exists
        $this->assertNull(DB::table('todos')->where('id', $latest->id)->first());
    }
}
