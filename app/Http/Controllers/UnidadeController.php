<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\User;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::all();
        return view('unidades.index', ['unidades' => $unidades]);
    }

    public function createUnidade()
    {
        return view('unidades.createUnidade');
    }

    private function rules()
    {
        return [
            'unidadeNome' => 'required|min:4|string',
            'unidadeSigla' => 'required|min:3|string',
            'unidadeEmail' => 'required|email',
            'gestor_id' => 'nullable|exists:users,id',
        ];
    }

    private function validateUnidadeData($validatedData, $id = null)
    {
        if (Unidade::where('unidadeEmail', $validatedData['unidadeEmail'])->where('id', '!=', $id)->exists()) {
            return 'O e-mail informado já está sendo utilizado por outra unidade. Por favor, tente outro e-mail.';
        }

        if ($validatedData['gestor_id'] && !User::find($validatedData['gestor_id'])) {
            return 'O gestor selecionado não foi encontrado. Verifique se o ID está correto.';
        }

        return null;
    }

    public function insertUnidade(Request $request)
    {
        try {
            $validatedData = $request->validate($this->rules());

        
            if ($error = $this->validateUnidadeData($validatedData)) {
                return redirect()->back()->withErrors($error);
            }

           
            $unidade = Unidade::create([
                'unidadeNome' => $validatedData['unidadeNome'],
                'unidadeSigla' => $validatedData['unidadeSigla'],
                'unidadeEmail' => $validatedData['unidadeEmail'],
                'gestor_id' => $validatedData['gestor_id'] ?? null,
            ]);

            return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro inesperado ao criar a unidade. Tente novamente mais tarde.');
        }
    }

    public function editUnidade($id)
    {
        $unidade = Unidade::findOrFail($id);
        return view('unidades.editUnidade', ['unidade' => $unidade]);
    }

    public function updateUnidade(Request $request, $id)
    {
        try {
            $unidade = Unidade::findOrFail($id);
            $validatedData = $request->validate($this->rules());


            if ($error = $this->validateUnidadeData($validatedData, $id)) {
                return redirect()->back()->withErrors($error);
            }

            $unidade->update([
                'unidadeNome' => $validatedData['unidadeNome'],
                'unidadeSigla' => $validatedData['unidadeSigla'],
                'unidadeEmail' => $validatedData['unidadeEmail'],
            ]);

            return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro inesperado ao atualizar a unidade. Tente novamente mais tarde.');
        }
    }

    public function deleteUnidade($id)
    {
        try {
            $unidade = Unidade::findOrFail($id);
            $unidade->delete();

            return redirect()->back()->with('success', 'Unidade deletada com sucesso.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao tentar excluir a unidade. Tente novamente mais tarde.');
        }
    }
}
