<?php

namespace Tests\Feature;

use App\Models\Itineraire;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class itineraireTest extends TestCase
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
        $itineraire = Itineraire::where('id', 1)->get();
        $response = $this->getJson('/api/itineraire/display');
        $response->assertJson([
            'msg' => 'Les itineraires dans la plateforme',
            'itineraire' => $itineraire->toArray(),
        ]);
    }

    public function it_creates_itineraire_successfully()
    {
        // Création de l'utilisateur fictif pour l'authentification
        // $user = Factory(User::class)->create();
        // $this->actingAs($user);

        // Données de la requête
        $requestData = [
            'titre' => 'Titre de l\'itinéraire',
            'description' => 'Description de l\'itinéraire',
            'point_depart' => 'Point de départ',
            'point_arrivee' => 'Point d\'arrivée',
            'date' => '2024-03-28',
            'duree' => '2 heures',
            'category_id' => 1,
        ];

        $response = $this->json('POST', '/itineraire', $requestData);

        $response->assertStatus(200);

        $response->assertJson([
            'msg' => 'Itineraire created successfully',
        ]);
        $user_id = 1;

        $this->assertDatabaseHas('itineraires', [
            'titre' => $requestData['titre'],
            'description' => $requestData['description'],
            'point_depart' => $requestData['point_depart'],
            'point_arrivee' => $requestData['point_arrivee'],
            'date' => $requestData['date'],
            'duree' => $requestData['duree'],
            'category_id' => $requestData['category_id'],
            'user_id' => $user_id,
        ]);

        $itineraire = Itineraire::where('titre', $requestData['titre'])->first();
        $this->assertNotNull($itineraire);
    }
    
}
