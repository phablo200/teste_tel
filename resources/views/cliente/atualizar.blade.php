@extends('extends.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text">
                        <i class="fa fa-user-plus"></i>
                        Atualizar cliente
                      </h3>
                    </div>
                  </div>
              </div>

              <div class="m-portlet__body">

                 <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                            method="POST" action="{{route('cliente.atualizar', [$id])}}" id="formNovaCobranca">
                        {{csrf_field()}}

                        <div class="form-group m-form__group row">
                            <div class="col-md-6">
                                <label class="control-label" for='local_nascimento'>
                                    Local de nascimento
                                </label>
                                <select name="local_nascimento" id="local_nascimento" class="form-control {{ $errors->has('local_nascimento') ? 'has-error' : ''}}">
                                  <option value="">SELECIONE</option> 
                                  <option @if($cliente->local_nascimento=='BA') selected @endif value="BA">BA</option>
                                  <option @if($cliente->local_nascimento=='SP') selected @endif value="SP">SP</option>  
                                </select>
                                @if($errors->has('local_nascimento'))
                                <span style='color: red;'>
                                  {{$errors->first('local_nascimento')}}
                                </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="control-label" for='data_nascimento'>
                                    Data de nascimento
                                </label>
                                <input type="text" name="data_nascimento" id="data_nascimento" class="form-control {{ $errors->has('data_nascimento') ? 'has-error' : ''}}"
                                value="{{date('d/m/Y', strtotime($cliente->data_nascimento))}}"
                                />
                                @if($errors->has('data_nascimento'))
                                <span style='color: red;'>
                                  {{$errors->first('data_nascimento')}}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-md-12">
                                <label class="control-label" for='nome'>
                                    Nome
                                </label>

                                <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? 'has-error' : ''}}" value="{{$cliente->nome}}"/>
                                @if($errors->has('nome'))
                                <span style='color: red;'>
                                  {{$errors->first('nome')}}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-md-6">
                                <label class="control-label" for='rg'>
                                    RG
                                </label>
                                <input type="text" name="rg" id="rg" class="form-control {{ $errors->has('rg') ? 'has-error' : ''}}" value="{{$cliente->rg}}"/>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label" for='cpf'>
                                    CPF
                                </label>
                                <input type="text" name="cpf" id="cpf" class="form-control {{ $errors->has('cpf') ? 'has-error' : ''}}" value="{{$cliente->cpf}}"/>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-md-6">
                              <a href="{{route('cliente.index')}}" class="btn btn-outline-info" @click="btnCancelar($event);">
                                <i class="fa fa-arrow-left"></i>
                                Voltar
                              </a>
                                
                              <button  class="btn btn-primary" @click="btnSalvar($event);" id="btnSalvar">
                                <i class="fa fa-check"></i>
                                Salvar
                              </button>
                            </div>
                        </div>
                  </form>
              </div>
        </div>
     </div>
    </div>
</div>
@endsection



@push('footer')
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.pt-BR.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-mask/jquery.mask.js')}}"></script> 
<script>
  $(function () {
    $('#data_nascimento').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true
    });
    $('#data_nascimento').mask("99/99/9999");
  });
</script>
@endpush