@extends('layouts.admin')

@section('conteudo')

<section>
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro ao salvar.
            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible bg-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> Registro salvo com sucesso.
            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif
    {{ Form::model($cliente, ['method' => 'PATCH','route'=>['cad-cliente.update',$cliente->CODCLIENTE], 'id' => 'cliente', 'class' => 'cadastro', 'files' => true]) }}
        
        <div class="col-12">
            <button type="submit" class="btn btn-secondary my-2 mr-1" title="Salvar"><i class="fas fa-save"></i></button>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Excluir"><i class="fas fa-trash"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Imprimir"><i class="fas fa-print"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Simular Preço"><i class="fas fa-calculator"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Histórico de Compras"><i class="fas fa-truck"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Histórico de Vendas"><i class="fas fa-cart-arrow-down"></i></a>
        </div>
        {!! Form::hidden('TIPO', null,array( 'class' => 'form-group cpf_cnpj', 'autocomplete' => 'off')) !!}
    <!-- Informações Gerais -->
        @if($cliente->TIPO == "F")
        <div class="form-group"></div>
        <div class="row" id="fisica">
            <div class="form-group col-md-4">
                {!! Form::label('CPF', 'CPF', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CPF', $cliente->CPF_CNPJ, array('id'=>'CPF', 'class' => 'form-control ', 'placeholder' => 'Somente Nº', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('NOME', 'Nome', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('NOME', $cliente->DES_NOME, array( 'class' => 'form-control', 'placeholder' => 'Nome completo', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('DT_NASCIMENTO', 'Nascimento', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::date('DT_NASCIMENTO', $cliente->DT_NASCIMENTO, array( 'class' => 'form-control', 'placeholder' => 'Número do RG', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('APELIDO', 'Como prefere ser chamado', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('APELIDO', $cliente->DES_RAZAO, array( 'class' => 'form-control', 'placeholder' => 'Nome de preferência', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        @else
        <div class="form-group"></div>
        <div  class="row" id="juridica">
            <div class="form-group col-md-3">
                {!! Form::label('CPF_CNPJ', 'CNPJ', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CPF_CNPJ', null, array('id'=>'CNPJ', 'class' => 'form-control cpf_cnpj', 'placeholder' => 'Somente Nº', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('DES_NOME', 'Fantasia', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('DES_NOME', null, array('class' => 'form-control', 'placeholder' => 'Nome completo', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('DES_RAZAO', 'Razão Social', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('DES_RAZAO', null, array('class' => 'form-control', 'placeholder' => 'Nome de preferência', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        @endif
        <h4>Contato</h4>
        <div class="form-group"></div>
        <div class="row">
            <div class="form-group col-md-3">
                {!! Form::label('CTT_FONE', 'Fone', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CTT_FONE', null, array( 'class' => 'form-control', 'placeholder' => 'Telefone Fixo', 'autocomplete' => 'off')) !!}
            </div>                                
            <div class="form-group col-md-3">
                {!! Form::label('CTT_CELULAR', 'Celular', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CTT_CELULAR', null, array( 'class' => 'form-control', 'placeholder' => 'Celular', 'autocomplete' => 'off')) !!}
            </div>                                
            <div class="form-group col-md-6">
                {!! Form::label('CTT_EMAIL', 'E-Mail', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CTT_EMAIL', null, array('class' => 'form-control', 'placeholder' => 'exemplo@exemplo.com', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="form-group"></div>
        <h4>Endereço</h4>
        <div class="row">
           
            <div class="form-group col-sm-4"> 
                {!! Form::label('CEP', 'CEP') !!}
                {!! Form::text('CEP', null, array('placeholder' => 'CEP', "maxlength" => "9", 'onblur' => "pesquisacep(this.value);", 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-2"> 
                {!! Form::label('ESTADO', 'UF') !!}
                {!! Form::text('ESTADO', null, array('placeholder' => 'UF', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-4"> 
                {!! Form::label('CIDADE', 'Cidade') !!}
                {!! Form::text('CIDADE', null, array('placeholder' => 'Cidade', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-4"> 
                {!! Form::label('END_BAIRRO', 'Bairro') !!}
                {!! Form::text('END_BAIRRO', null, array('placeholder' => 'Bairro', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-4"> 
                {!! Form::label('END_LOGRADOURO', 'Logradouro') !!}
                {!! Form::text('END_LOGRADOURO', null, array('placeholder' => 'Logradouro', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-4"> 
                {!! Form::label('NUMERO', 'Número') !!}
                {!! Form::text('NUMERO', null, array('placeholder' => 'Numero', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-sm-12"> 
                {!! Form::label('REF', 'Referência') !!}
                {!! Form::text('REF', null, array('class' => 'form-control', 'placeholder' => 'Nome da Empresa', 'autocomplete' => 'off')) !!}
            </div>
        </div>
    {{ Form::close() }}
</section>

@stop
   
@section('scripts')
    
    
@endsection