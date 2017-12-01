@extends('layout')

@section('content')
<h4>Consultar uma transação</h4>
<div>
Estamos consultando a transação:<br />
{{$consulta->getId()}}

<p class="bg-dark text-white p-2">
	<b>Status:</b> {{$consulta->getStatus()}}<br />
	<b>Valor Total:</b> <span class="valorEmReal">{{str_replace(".",",",$consulta->getAmountTotal())}}</span><br />

	<b>Produtos:</b><br />

	@foreach($consulta->getItemIterator() as $key => $value)
  
    {{$key}} =>
    Produto: {{$value->product}} /
    Preço: <span class="valorEmReal">{{$value->price}}</span> /
    Quantidade: {{$value->quantity}} /
    Detalhe: {{$value->detail}}
    <br />
	@endforeach
  
</p>
</div>

@endsection

@section('javascript')
   <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
   <script type="text/javascript" src="{{asset('js/jquery.priceformat.min.js')}}"></script>
   <script type="text/javascript">
    $(".valorEmReal").priceFormat({
      prefix: 'R$ ',
      centsSeparator: ',',
      thousandsSeparator: '.'
    });
   </script>
@endsection