@extends('extends.layout')


@push('header')
<style type="text/css">
.jconfirm-box-container {
    margin-left: 40%;
}
</style>
@endpush

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text">
                        <i class="fa fa-phone"></i>
                        Gerênciar telefones {{ucfirst($cliente->nome)}}
                      </h3>
                    </div>
                  </div>
              </div>

              <div class="m-portlet__body">

                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                            method="POST" action="{{route('cliente.telefones-salvar', [$cliente->id])}}">
                        {{csrf_field()}}

                        <div class="form-group m-form__group row">
                        
                        <div class="col-md-12">
                                <label class="control-label" for='numero'>
                                    Telefone
                                </label>

                                <input type="text" onkeyup='telGlobal("numero")' name="numero" id="numero" class="form-control {{ $errors->has('numero') ? 'has-error' : ''}}" maxlength="15" 
                                />
                                @if($errors->has('numero'))
                                <span style='color: red;'>
                                  {{$errors->first('numero')}}
                                </span>
                                @endif
                        </div>
                        </div>


                         <div class="form-group m-form__group row">
                            <div class="col-md-6">
                              <a href="{{route('cliente.index')}}" class="btn btn-outline-info">
                                <i class="fa fa-arrow-left"></i>
                                Voltar
                              </a>
                                
                              <button  class="btn btn-primary" id="btnSalvar">
                                <i class="fa fa-check"></i>
                                Salvar
                              </button>
                            </div>
                        </div>
                </form>

                <hr/>

                <h4>Telefones cadastrados</h4>
                <table class="table" id="tabela" style='zoom: 90%;'>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Opções</th>
                            <th style="text-align: right;">Id</th>
                            <th style="text-align: left;">Número</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($telefones))
                            @foreach ($telefones as $telefone)
                                <tr> 
                                    <td style='text-align: center'>
                                        <a href="javascript:;" onclick='btnExcluir("{{$telefone->id}}", "{{$cliente->id}}")' class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td style="text-align: right;">{{$telefone->id}}</td>
                                    <td style="text-align: left;">{{$telefone->numero}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
             </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
<script>
    function btnExcluir(id, id_cliente)
    {
        var rota="{{route('cliente.telefones-excluir', ['idCliente', 'idTelefone'])}}"
            .replace('idTelefone', id)
            .replace('idCliente', id_cliente);
        $.confirm({
            title: "ATENÇÃO",
            content: "Deseja realmente excluir este telefone ?",
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