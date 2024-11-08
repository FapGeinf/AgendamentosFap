<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalaController extends Controller
{
        public function index()
        {
                $salas = Sala::all();
                
                return view('salas.index',['salas' => $salas]);
        }

        public function createSala()
        {
                return view('salas.createSala');
        }

        private function rules()
        {
            return [
                'nome' => 'required|string|min:2',
                'descricao' => 'required|string|min:4',
            ];
        }

        public function insertSala(Request $request)
        {
            try {
                $validatedData = $request->validate($this->rules());
                
                $sala = Sala::create([
                    'nome' => $validatedData['nome'],
                    'descricao' => $validatedData['descricao']
                ]);

                if (!$sala) {
                    return redirect()->back()->withErrors('Houve um erro ao inserir uma nova sala, por favor verifique os campos preenchidos');
                }

                return redirect()->route('salas.index')->with('success', 'Sala inserida com sucesso');
                
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Ocorreu um erro inesperado: ' . $e->getMessage());
            }
        }

        public function editSala($id)
        {
               $sala = Sala::findorFail($id);

               return view('salas.editSala',['sala' => $sala]);
        }

        public function updateSala(Request $request, $id)
        {
            try {
                $sala = Sala::findOrFail($id); 

                $validatedData = $request->validate($this->rules());

                $sala->update([
                    'nome' => $validatedData['nome'],
                    'descricao' => $validatedData['descricao'],
                ]);

                return redirect()->back()->with('success', 'A sala foi atualizada com sucesso');
                
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return redirect()->back()->withErrors('A sala não foi encontrada.');
                
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Houve algum erro: ' . $e->getMessage());
            }
        }

        public function deleteSala($id)
        {
            try {
                $sala = Sala::findOrFail($id);

                $sala->delete();

                return redirect()->back()->with('success', 'A sala foi deletada com sucesso');
                
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Houve algum erro: ' . $e->getMessage());
            }
        }



}
