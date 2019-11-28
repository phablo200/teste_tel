@extends('extends.layout')

@push('header')
    
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
        <h2>Usuários</h2>
    </div>
</div>


<div class="row" style='margin-top: 2%'>
    <div class="col-md-12">
        <a href="{{route('usuario.criar')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Adicionar
        </a>
    </div>
</div>

<div class="row" style="margin-top: 2%;">
	<div class="col-md-12">
    	<div class="m-portlet m-portlet--mobile">
	        <div class="m-portlet__body">
	             <table class="table" id="tabela">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Opções</th>
                            <th style="text-align: right;">Id</th>
                            <th style="text-align: left;">Nome</th>
                            <th style="text-align: left;">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($usuarios))
                            @foreach ($usuarios as $usuario)
                            <tr> 
                                <td style='text-align: center'>
                                    <a href="{{route('usuario.editar', [$usuario->id])}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="javascript:;" onClick='btnExcluir({{$usuario->id}});' class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td style="text-align: right;">{{$usuario->id}}</td>
                                <td style="text-align: left;">{{$usuario->nome}}</td>
                                <td style="text-align: left;">{{$usuario->email}}</td>
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
            var rota="{{route('usuario.excluir', ['id'])}}".replace('id', id);
            $.confirm({
                title: "ATENÇÃO",
                content: "Deseja realmente excluir este usuário ?",
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