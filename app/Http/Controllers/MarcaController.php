<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class MarcaController extends Controller
{
    public $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marcas = array();

        if($request->has('atributos_modelos')) {
            $atributos_modelos = $request->atributos_modelos;
            $marcas = $this->marca->with('modelos:id,'.$atributos_modelos);
        } else {
            $marcas = $this->marca->with('modelos');
        }

        if($request->has('filtro')) {
            $filtros = explode(';', $request->filtro);
            foreach($filtros as $key => $condicao) {

                $c = explode(':', $condicao);
                $marcas = $marcas->where($c[0], $c[1], $c[2]);

            }
        }

        if($request->has('atributos')) {
            $atributos = $request->atributos;
            $marcas = $marcas->selectRaw($atributos)->get();
        } else {
            $marcas = $marcas->get();
        }


        //$marcas = Marca::all();
        //$marcas = $this->marca->with('modelos')->get();
        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $marca = Marca::create($request->all());
        $request->validate($this->marca->rules(), $this->marca->feedback());
        //stateless
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/marcas', 'public');

        $marca = $this->marca->create(['nome' => $request->nome, 'imagem' => $imagem_urn]);
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $marca = Marca::find($marca);
        $marca = $this->marca->with('modelos')->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Não encontrado'], 404);
        }
        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }
        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();
            //percorrendo todas as regras definidas no Model
            foreach ($marca->rules() as $input => $regra) {
                //coletar apenas as regras aplicaiveis aos parâmetros parciais
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $this->marca->feedback());
        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        // Removendo imagem anterior ao realizar a atualização
        if($request->file('imagem')){
            FacadesStorage::disk('public')->delete($marca->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/marcas', 'public');

        /*
         Para resolver o problema de patch,  usamos o metodo fill e atualizamos 
         os campos faltantes resgatando do banco os dados, o fill pega os dados do request e atualiza os campos
         e subistitui no obj e por fim salvamos o novo cminho da imagem usando urn da imagem. Agora usamos o metodo save do objeto da Classe.
         */
        $marca->fill($request->all());
        $marca->imagem = $imagem_urn;
        $marca->save();

        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Não foi possiverl realizar operação'], 404);
        }
       
        FacadesStorage::disk('public')->delete($marca->imagem);
        
        $marca->delete();
        return response()->json(['msg' => 'Deletado'], 200);
    }
}
