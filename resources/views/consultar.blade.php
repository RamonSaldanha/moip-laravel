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
<h5>Todas os parametros que você pode recuperar numa consulta:</h5>
<p>
<pre style="height:300px">
    $consulta->getId()
    $consulta->getOwnId()
    $consulta->getAmountTotal()
    $consulta->getAmountFees()
    $consulta->getAmountRefunds()
    $consulta->getAmountLiquid()
    $consulta->getAmountOtherReceivers()
    $consulta->getCurrenty()
    $consulta->getSubtotalShipping()
    $consulta->getSubtotalAddition()
    $consulta->getSubtotalDiscount()
    $consulta->getSubtotalItems()
    $consulta->getItemIterator()
    $consulta->getCustomer()
    $consulta->getPaymentIterator()
    $consulta->getReceiverIterator()
    $consulta->getEventIterator()
    $consulta->getRefundIterator()
    $consulta->getStatus()
    $consulta->getCreatedAt()
    $consulta->getUpdatedAt()
    $consulta->getCheckoutPreferences()
    $consulta->getList()
</pre>
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