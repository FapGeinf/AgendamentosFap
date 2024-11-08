<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Unidade;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('sala')->get();
        return view('reservas.index', ['reservas' => $reservas]);
    }

    public function createReserva()
    {
        $unidades = Unidade::all();
        $salas = Sala::all();
        return view('reservas.createReserva', ['unidades' => $unidades, 'salas' => $salas]);
    }

   
    public function rulesForCreate()
    {
        return [
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date', 
            'unidade_id' => 'nullable|exists:unidades,id', 
            'usuario_id' => 'required|exists:users,id', 
            'sala_id' => 'required|exists:salas,id' 
        ];
    }

    
    public function rulesForUpdate()
    {
        return [
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date', 
            'unidade_id' => 'nullable|exists:unidades,id', 
            'usuario_id' => 'nullable|exists:users,id', 
            'sala_id' => 'nullable|exists:salas,id' 
        ];
    }

    
    public function insertReserva(Request $request)
    {
        try {
            $validatedData = $request->validate($this->rulesForCreate()); 

            $user = auth()->user();

            $reserva = Reserva::create([
                'data_inicio' => $validatedData['data_inicio'],
                'data_fim' => $validatedData['data_fim'],
                'unidade_id' => $validatedData['unidade_id'] ?? null,
                'usuario_id' => $user->id, 
                'sala_id' => $validatedData['sala_id'] 
            ]);

            if (!$reserva) {
                return redirect()->back()->withErrors(['erro' => 'Falha ao criar a reserva.']);
            }

            return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao inserir a reserva: ' . $e->getMessage());
            return redirect()->back()->withErrors(['erro' => 'Ocorreu um erro ao criar a reserva.']);
        }
    }

   
    public function editReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
        $unidades = Unidade::all();
        $salas = Sala::all();
        return view('reservas.editReserva', ['unidades' => $unidades, 'salas' => $salas, 'reserva' => $reserva]);
    }

   
    public function updateReserva(Request $request, $id)
    {
        try {
            $reserva = Reserva::findOrFail($id);
        
            $validatedData = $request->validate($this->rulesForUpdate()); 
        
            $reserva->update([
                'data_inicio' => $validatedData['data_inicio'],
                'data_fim' => $validatedData['data_fim'],
                'unidade_id' => $validatedData['unidade_id'] ?? null,  
                'sala_id' => $validatedData['sala_id'] ?? $reserva->sala_id 
            ]);
        
            return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar a reserva: ' . $e->getMessage());
            return redirect()->back()->withErrors(['erro' => 'Ocorreu um erro ao atualizar a reserva.']);
        }
    }

    public function deleteReserva($id)
    {
           try{
               $reserva = Reserva::findorFail($id);

               $reserva->delete();

               return redirect()->back()->with('success','Reserva cancelada com sucesso');

           }catch(\Exception $e){
               Log::error('Erro ao deletar a reserva: ' . $e->getMessage());
               return redirect()->back()->withErrors('Houve um erro ao deletar a reserva');
           }
    }
}
