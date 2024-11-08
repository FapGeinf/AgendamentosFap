<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Sala;


class SalaControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

     /**
     * Testa a inserção de uma nova sala com dados válidos.
     */
    public function test_insert_sala_successfully()
    {
      
        $data = [
            'nome' => 'Sala de Reunião',
            'descricao' => 'Sala para reuniões e conferências',
        ];

       
        $response = $this->post(route('salas.insert'), $data);

    
        $this->assertDatabaseHas('salas', $data);

      
        $response->assertRedirect(route('salas.index'));
        $response->assertSessionHas('success', 'Sala inserida com sucesso');
    }

    /**
     * Testa a inserção de uma sala com dados inválidos.
     */
    public function test_insert_sala_with_invalid_data()
    {
      
        $data = [
            'nome' => 'A', 
            'descricao' => '', 
        ];

      
        $response = $this->post(route('salas.insert'), $data);

     
        $this->assertDatabaseMissing('salas', $data);

      
        $response->assertSessionHasErrors(['nome', 'descricao']);
    }

    /**
     * Testa o tratamento de exceção.
     */
    public function test_insert_sala_throws_exception()
    {
      
        $this->mock(Sala::class, function ($mock) {
            $mock->shouldReceive('create')->andThrow(new \Exception('Erro de banco de dados'));
        });


        $data = [
            'nome' => 'Sala de Conferência',
            'descricao' => 'Espaço para conferências',
        ];

        $response = $this->post(route('salas.insert'), $data);
        $response->assertSessionHasErrors('Ocorreu um erro inesperado: Erro de banco de dados');
    }
}
