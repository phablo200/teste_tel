@extends('extends.layout')


@push('header')
<style type="text/css">
.jconfirm-box-container {
    margin-left: 40%;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Clientes</h2>
    </div>
</div>


<div class="row" style='margin-top: 2%'>
    <div class="col-md-12">
        <a href="{{route('cliente.criar')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Adicionar
        </a>
    </div>
</div>

<div class="row" style="margin-top: 2%;">
	<div class="col-md-12">
    	<div class="m-portlet m-portlet--mobile">
	        <div class="m-portlet__body">
	             <table class="table" id="tabela" style='zoom: 90%;'>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Opções</th>
                            <th style="text-align: right;">Id</th>
                            <th style="text-align: left;">Nome</th>
                            <th style="text-align: center;">RG</th>
                            <th style="text-align: center;">CPF</th>
                            <th style="text-align: center;">Dt. Nascimento</th>
                            <th style="text-align: center;">LC. Nascimento</th>
                            <th style="text-align: center;">Cadastro</th>
                            <th style="text-align: center;">Ult. atualização</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($clientes))
                            @foreach ($clientes as $cliente)
                                <tr> 
                                    <td style='text-align: center'>
                                        <a href="{{route('cliente.editar', [$cliente->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{route('cliente.telefones', [$cliente->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                        <a href="javascript:;" onclick='btnExcluir("{{$cliente->id}}")' class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td style="text-align: right;">{{$cliente->id}}</td>
                                    <td style="text-align: left;">{{$cliente->nome}}</td>
                                    <td style="text-align: center;">{{$cliente->rg}}</td>
                                    <td style="text-align: center;">{{$cliente->cpf}}</td>
                                    <td style="text-align: center;">{{date("d/m/Y", strtotime($cliente->data_nascimento))}}</td>
                                    <td style="text-align: center;">{{$cliente->local_nascimento}}</td>
                                    <td style="text-align: center;">
                                        {{date("d/m/Y H:i", strtotime($cliente->data_cadastro))}}
                                        <br/>
                                        <small>{{$cliente->nome_cadastrou}}</small>
                                    </td>
                                    <td style="text-align: center;">
                                        @if (!is_null($cliente->data_atualizacao))
                                        {{date("d/m/Y H:i", strtotime($cliente->data_atualizacao))}}
                                        <br/>
                                        <small>{{$cliente->nome_atualizou}}</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
	        </div>
   	 	</div>
   	</div>
</div>



@endsection

@push('footer')
<script>
    function btnExcluir(id)
    {
        var rota="{{route('cliente.excluir', ['id'])}}".replace('id', id);
        $.confirm({
            title: "ATENÇÃO",
            content: "Deseja realmente excluir este cliente ?",
            buttons: {
                confirm: {
                    text: "Sim",
                    btnClass: "btn-success",
                    action: function () {
                        location.href=rota;
                    }
                },

                cancel: {
                    text: 'Não',
                    btnClass: 'btn-danger',
                        action: function () {
                            
                    }
                }
            }
        });
    } 
</script>
@endpush