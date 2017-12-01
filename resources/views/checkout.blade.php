@extends('layout')

@section('content')


@if(Session::has('mensagem_sucesso'))
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <li>{!! Session::get('mensagem_sucesso') !!}</li>
    </div>
@endif


{!! Form::open(['route' => 'validar', 'class' => 'mb-5']) !!}

  <div class="form-row">

    <div class="form-group col-md-auto">
      <label>Bandeira</label>
      <input type="text" class="form-control" placeholder="Card Type" id="card_type" name="card_type" />
    </div>

    <div class="form-group col-md-auto">
      <label>Nº de prestações</label>
      <input type="number" class="form-control" style="max-width:80px;" placeholder="CVC" id="prestacoes" name="prestacoes" value="3" />
    </div>

    <div class="form-group col-md-8">
      <label>Nº do cartão</label>
      <input type="text" class="form-control" placeholder="Credit card number" id="cc_number" value="4073020000000002" style="max-width:220px;" name="cc_number" />
    </div>

  </div>

  <div class="form-row">

    {{--  <div class="col-12">
      <label>Vencimento do cartão</label>
    </div>  --}}

    <div class="form-group col-md-2 col-sm-3 col-3">
    <label>Mês</label>
      <input type="text" class="form-control" placeholder="Month" id="cc_exp_month" value="12" name="cc_exp_month" />
    </div>
    <div class="form-group col-md-2 col-sm-3 col-3">
    <label>Ano</label>
      <input type="text" class="form-control" placeholder="Year" id="cc_exp_year" name="cc_exp_year" value="21" />
    </div>

    <div class="form-group col-md-4 ml-5">
      <label>Cód. Segurança</label>
      <input type="text" class="form-control" style="max-width:80px;" placeholder="CVC" id="cc_cvc" name="cc_cvc" value="123" />
    </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Public Key (da sua conta)</label>
      <textarea id="public_key" name="public_key" class="form-control" rows="8">-----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu0bPPM4bzDGxCEk3vSDH
    p7OEnfk8HaDUYPs0MTh1TOIGQn13tTYzx9wm4HUk7o3d08cDoiXnxjEGwyIZxLkS
    HkjgJjdD6Q+T1qONo8+2J7SsU+3cCF/BDSUXb7I/8IHKE9Z4UizYtTJkhVOQo7dW
    ln5fySpvbV9sqGN0FkDoc1Pn9H+eEcohgyTBMUyrwBoAhQm2IpyK2uZP2NTXPbrQ
    DxgNjUJyjC73fwWHtY+1yyD0TxIF0E+fbqVPAGvFO2bKxcQ9hCeD552EtimpKtQv
    8wbvu5dh6yL29gX37FqBPbRgQISBcKY2VGN99QLLQNEqNCJeKMvM8hhhlAAXsCrV
    oQIDAQAB
    -----END PUBLIC KEY-----</textarea>
    </div>
    <div class="form-group col-md-6">
      <label>Hash do cartão</label>
      <textarea id="encrypted_value" name="hash" rows="8" class="form-control"></textarea>

    </div>
  </div>
    

<input type="button" value="Gerar hash do cartão" id="encrypt" class="btn btn-dark btn-block"/>
  <input type="submit" value="Pagar" id="encrypt" class="btn btn-success btn-block" />
  
{!! Form::close() !!}


@endsection

@section('javascript')

 <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
      <!-- Moip.js -->
  <script type="text/javascript" src="http://assets.moip.com.br/integration/moip.min.js"></script>
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#encrypt").click(function() {
          var cc = new Moip.CreditCard({
            number  : $("#cc_number").val(),
            cvc     : $("#cc_cvc").val(),
            expMonth: $("#cc_exp_month").val(),
            expYear : $("#cc_exp_year").val(),
            pubKey  : $("#public_key").val()
          });
          console.log(cc);
          if( cc.isValid()){
            $("#encrypted_value").val(cc.hash());
            $("#card_type").val(cc.cardType());
          }
          else{
            $("#encrypted_value").val('');
            $("#card_type").val('');
            alert('Invalid credit card. Verify parameters: number, cvc, expiration Month, expiration Year');
          }
        });
    });
  </script>
@endsection