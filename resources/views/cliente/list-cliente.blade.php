@extends('layouts.admin')

@section('conteudo')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de clientes <a href="{{route('cad-cliente.index')}}"><button class="btn btn-success">Novo</button></a></h3>
		{!!Form::open(array('url'=>'list', 'method'=>'GET', 'autocomplete'=>'off'))!!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
	</div>
</div>

<div class="row ">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table table-hover table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nome</th>
					<th>RAZAO</th>
					<th>Opções</th>
				</thead>
               @foreach ($cliente as $clientes)
				<tr>
					<td>{{ $clientes->CODCLIENTE}}</td>
					<td>{{ $clientes->DES_NOME}}</td>
					<td width="40%">{{ $clientes->DES_RAZAO}}</td>
					<td>
						<a href="{{route('cad-cliente.edit',$clientes->CODCLIENTE)}}"><button class="btn btn-info">Editar</button></a>
						{!!Form:: model($clientes,array('method'=>'DELETE','route'=>['cad-cliente.destroy',$clientes->CODCLIENTE]))!!}
                         <button style="margin-left: 70px;margin-top: -55px"" class="btn btn-danger">Excluir</button>
                         {{ Form::close()}}
						
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$cliente->render()}} 
		
	</div>
</div>

@stop