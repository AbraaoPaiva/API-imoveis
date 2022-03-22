<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imoveis;
use App\Http\Controllers\Exception;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailUser;

class ControllerImoveis extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $imoveis = Imoveis::paginate(4); //quantidade por página
            return $imoveis->toJson();
        } catch (Exception $e) {
            return response()->json(['erro' => $e], 402);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $imoveisDefault = new Imoveis();
            $errorsImoveis = $imoveisDefault->validacao($request);
            if(!$errorsImoveis){
            $imovel = Imoveis::Create([
                'tipo_id'      => request('tipo_id'),
                'negocio_id'   => request('negocio_id'),
                'anunciante'   => request('anunciante'),
                'email'        => request('email'),
                'pais'         => request('pais'),
                'estado'       => request('estado'),
                'cidade'       => request('cidade'),
                'bairro'       => request('bairro'),
                'rua'          => request('rua'),
                'complemento'  => request('complemento'),
                'cep'          => request('cep'),
                'telefone'     => request('telefone')
            ]);
            $imovel->save();
            
            $nomeAnunciante = $imovel->anunciante; //nome do anunciando para ser enviado juntamento ao email
        
            Mail::to(users: $imovel->email)->send(new EnviarEmailUser($nomeAnunciante)); //enviar um e-mail confirmando a criação do imóvel
            return response()->json(["Imóvel cadastrado com sucesso!"]);
        }else{
            return response()->json(['error' => $errorsImoveis], 400);
        }
        } catch (Exception $e) {
            return response()->json(['erro' => $e], 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $imovel = Imoveis::find($id);
            //dd($imovel);
            if(!isset($imovel)){
            throw new \Exception("Imóvel não encontrado", 2);
            }
            $imovel = DB::table('imovel')->where('imovel.id', $id)->join('tipo', 'imovel.tipo_id', '=', 'tipo.id')->join('negocio', 'imovel.negocio_id', '=', 'negocio.id')->select(
                'tipo.nome', 
                'negocio.modelo',
                'imovel.anunciante',
                'imovel.email',
                'imovel.pais',
                'imovel.bairro',
                'imovel.rua',
                'imovel.complemento',
                'imovel.cep',
                'imovel.telefone')->get();
            //dd($imovel);
            return response()->json(['Dados do imóvel:' => $imovel]);
        } catch (Exception $e) {
            return response()->json(['erro' => $e], 501);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $imovel = Imoveis::find($id); //procurando id do imovel
        try {
            if (!isset($imovel)) {
                throw new \Exception("O imóvel não existe", 2);
            }
            $imoveisDefault = new Imoveis();
            $errorsImoveis = $imoveisDefault->validacao($request);
            if(!$errorsImoveis){
                $imovel->tipo_id =     request("tipo_id");
                $imovel->negocio_id =  request("negocio_id");
                $imovel->anunciante =  request("anunciante");
                $imovel->email =       request("email");
                $imovel->pais =        request("pais");
                $imovel->estado =      request("estado");
                $imovel->cidade =      request("cidade");
                $imovel->bairro =      request("bairro");
                $imovel->rua =         request("rua");
                $imovel->complemento = request("complemento");
                $imovel->cep =         request("cep");
                $imovel->telefone =    request("telefone");
            $imovel->save();
            return response()->json(["Imóvel atualizado com sucesso!"]);
        }else{
            return response()->json(['error' => $errorsImoveis], 400);
        }
        } catch (Exception $e) {
            return response()->json(['erro' => $e], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $imovel = Imoveis::find($id);
            if (!isset($imovel)) {
                throw new \Exception("Imóvel não encontrado", 2);
            }
            $imovel->delete();
            return response()->json(["Imóvel deletado com sucesso!"]);
        } catch (\Exception $e) {
            return ($e->getMessage());
        }

    }
}
