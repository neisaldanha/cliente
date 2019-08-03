<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
use App\Model\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cliente.form-clientes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($input['TIPO'] == 'F'){
             $rules  = [
                'CPF'   => 'required',
                'NOME'   => 'required',
                'DT_NASCIMENTO'   => 'required',
                'APELIDO'   => 'required',
                'CTT_FONE'   => 'required',
                'CTT_CELULAR'   => 'required',
                'CTT_EMAIL'   => 'required',
                'CEP'   => 'required',
                'ESTADO'   => 'required',
                'CIDADE'   => 'required',
                'END_BAIRRO'   => 'required',
                'END_LOGRADOURO'   => 'required',
                'NUMERO'   => 'required',
            ];
            $nomes   = [
                'CPF'   => 'CPF',
                'NOME'   => 'NOME',
                'DT_NASCIMENTO'   => 'Data de Nascimento ',
                'APELIDO'   => 'Como Prefere ser chamado ',
                'CTT_FONE'   => 'Telefone ',
                'CTT_CELULAR'   => 'Celular ',
                'CTT_EMAIL'   => 'E-mail ',
                'CEP'   => 'CEP',
                'ESTADO'   => 'ESTADO ',
                'CIDADE'   => 'CIDADE ',
                'END_BAIRRO'   => 'Bairro ',
                'END_LOGRADOURO'   => 'Logradouro ',
                'NUMERO'   => 'Numero '
            ];
        }else{
            $rules  = [
                'CPF_CNPJ'   => 'required',
                'DES_RAZAO'   => 'required',
                'DES_NOME'   => 'required',
                'CTT_FONE'   => 'required',
                'CTT_CELULAR'   => 'required',
                'CTT_EMAIL'   => 'required',
                'CEP'   => 'required',
                'ESTADO'   => 'required',
                'CIDADE'   => 'required',
                'END_BAIRRO'   => 'required',
                'END_LOGRADOURO'   => 'required',
                'NUMERO'   => 'required',
            ];
            $nomes   = [
                'CPF_CNPJ'   => 'CPF_CNPJ',
                'DES_RAZAO'   => 'Razao Social',
                'DES_NOME'   => 'Nome Fantasia',
                'CTT_FONE'   => 'Telefone ',
                'CTT_CELULAR'   => 'Celular ',
                'CTT_EMAIL'   => 'E-mail ',
                'CEP'   => 'CEP',
                'ESTADO'   => 'ESTADO ',
                'CIDADE'   => 'CIDADE ',
                'END_BAIRRO'   => 'Bairro ',
                'END_LOGRADOURO'   => 'Logradouro ',
                'NUMERO'   => 'Numero ',
            ];
        }
       
        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails())
        {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
         $cliente = new Cliente();

        if($input['TIPO'] == 'F'){

                $data = $input['DT_NASCIMENTO'];
                //return $data;
                // separando yyyy, mm, ddd
                 list($ano, $mes,$dia ) = explode('-', $data);

                // data atual
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

               // return $hoje;
                // Descobre a unix timestamp da data de nascimento do fulano
                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                //return $nascimento;
                // cálculo
                    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                    
                if ($idade < 19) {
                    
                        DB::rollBack();
                        Session::flash('error', true);
                        return redirect()->back()->withErrors('Menor de idade')->withInput();
                     
                }else{

                //return $input['DT_NASCIMENTO'];
                
                $input['DES_RAZAO'] = $input['APELIDO'];
                $input['DES_NOME'] = $input['NOME'];
                $input['CPF_CNPJ'] = $input['CPF'];
                $cliente->fill($input)->save();
                           
                }
        }else{

                $cliente->fill($input)->save();
            }
            
        Session::flash('success', true);
        return redirect()->back();
           

        
    }

    public function getCliente(Request $request)
    {
        $query = trim($request->get('searchText'));
        $cliente = Cliente::where('DES_NOME', 'LIKE','%'.$query.'%')
        ->paginate(5);
        //dd($cliente);
        return view('cliente.list-cliente')->with([
            'cliente'    => $cliente,
            'searchText' => $query,
        ]);
    }

public function getClienteJson()
    {
    
        $cliente = Cliente::get();
       return $cliente;
      
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cliente.edit-cliente',

            ['cliente' => Cliente::findOrFail($id)]);
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

        $input = $request->all();

        if($input['TIPO'] == 'F'){
             $rules  = [
                'CPF'   => 'required',
                'NOME'   => 'required',
                'DT_NASCIMENTO'   => 'required',
                'APELIDO'   => 'required',
                'CTT_FONE'   => 'required',
                'CTT_CELULAR'   => 'required',
                'CTT_EMAIL'   => 'required',
                'CEP'   => 'required',
                'ESTADO'   => 'required',
                'CIDADE'   => 'required',
                'END_BAIRRO'   => 'required',
                'END_LOGRADOURO'   => 'required',
                'NUMERO'   => 'required',
            ];
            $nomes   = [
                'CPF'   => 'CPF',
                'NOME'   => 'NOME',
                'DT_NASCIMENTO'   => 'Data de Nascimento ',
                'APELIDO'   => 'Como Prefere ser chamado ',
                'CTT_FONE'   => 'Telefone ',
                'CTT_CELULAR'   => 'Celular ',
                'CTT_EMAIL'   => 'E-mail ',
                'CEP'   => 'CEP',
                'ESTADO'   => 'ESTADO ',
                'CIDADE'   => 'CIDADE ',
                'END_BAIRRO'   => 'Bairro ',
                'END_LOGRADOURO'   => 'Logradouro ',
                'NUMERO'   => 'Numero '
            ];
        }else{
            $rules  = [
                'CPF_CNPJ'   => 'required',
                'DES_RAZAO'   => 'required',
                'DES_NOME'   => 'required',
                'CTT_FONE'   => 'required',
                'CTT_CELULAR'   => 'required',
                'CTT_EMAIL'   => 'required',
                'CEP'   => 'required',
                'ESTADO'   => 'required',
                'CIDADE'   => 'required',
                'END_BAIRRO'   => 'required',
                'END_LOGRADOURO'   => 'required',
                'NUMERO'   => 'required',
            ];
            $nomes   = [
                'CPF_CNPJ'   => 'CNPJ',
                'DES_RAZAO'   => 'Razao Social',
                'DES_NOME'   => 'Nome Fantasia',
                'CTT_FONE'   => 'Telefone ',
                'CTT_CELULAR'   => 'Celular ',
                'CTT_EMAIL'   => 'E-mail ',
                'CEP'   => 'CEP',
                'ESTADO'   => 'ESTADO ',
                'CIDADE'   => 'CIDADE ',
                'END_BAIRRO'   => 'Bairro ',
                'END_LOGRADOURO'   => 'Logradouro ',
                'NUMERO'   => 'Numero ',
            ];
        }
       
        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails())
        {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cliente = Cliente::findOrFail($id);
        #dd($input);
        if($input['TIPO'] == 'F'){

                $data = $input['DT_NASCIMENTO'];
                //return $data;
                // separando yyyy, mm, ddd
                 list($ano, $mes,$dia ) = explode('-', $data);

                // data atual
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

               // return $hoje;
                // Descobre a unix timestamp da data de nascimento do fulano
                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                //return $nascimento;
                // cálculo
                    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                    
                if ($idade < 19) {
                    
                        DB::rollBack();
                        Session::flash('error', true);
                        return redirect()->back()->withErrors('Idade minima para o cadastro é de 19 anos!')->withInput();
                     
                }else{
                    
                    $input['DES_RAZAO'] = $input['APELIDO'];
                    $input['DES_NOME'] = $input['NOME'];
                    $input['CPF_CNPJ'] = $input['CPF'];
                    $cliente->fill($input)->update();                    
                }

        }else{

            $cliente->fill($input)->update();
        }
        Session::flash('success', true);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return redirect()->back();
    }
}
