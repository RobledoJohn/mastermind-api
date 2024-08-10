<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_Login_Empresa_Existente()
    {

        // Simula una solicitud HTTP POST al login
        $response = $this->postJson('/api/auth', ['email' => 'admin@mastermind.co', 'clave' => 'Admin123']);

        // Verifica que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

    }
    public function test_Login_Empresa_No_Existente()
    {
        // Simula una solicitud HTTP POST a un email que no existe
        $response = $this->postJson('/api/auth', ['email' => 'admin@mastermind.com', 'clave' => 'Admin12345']);

        // Verifica que la respuesta sea un error 404
        $response->assertStatus(404);
    }
    public function test_Empresa_Existen_Ingresos()
    {
        // Simula una solicitud HTTP GET a un ingreso que existe
        $response = $this->getJson('api/1/ingresos');

        // Verifica que la respuesta sea 200
        $response->assertStatus(200);
    }
    public function test_Empresa_No_Existen_Ingresos()
    {
        // Simula una solicitud HTTP GET a un ingreso que no existe
        $response = $this->getJson('api/5/ingresos');

        // Verifica que la respuesta sea un error 404
        $response->assertStatus(404);
    }

}
