<?php

namespace Tests\Feature;

use App\Models\Itineraire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_return(){
        
        $search = 'titre';
        $itineraire = Itineraire::where('titre', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->get();
        $response = $this->json('post', '/api/itineraire/search');
        $response->assertJson([
            'msg' => 'your result about' . ' ' . $search,
            'itineraire' => $itineraire->toArray(),
        ]);
    }
}
