<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})
->name('inicio');

Route::post('/validar', function(){
        
    $moip = Moip::start();
    
    try {
        $customer = $moip->customers()->setOwnId(uniqid())
            ->setFullname('Fulano de Tal')
            ->setEmail('fulano@email.com')
            ->setBirthDate('1988-12-30')
            ->setTaxDocument('22222222222')
            ->setPhone(11, 66778899)
            ->addAddress('BILLING',
                'Rua de teste', 123,
                'Bairro', 'Sao Paulo', 'SP',
                '01234567', 8)
            ->addAddress('SHIPPING',
                    'Rua de teste do SHIPPING', 123,
                    'Bairro do SHIPPING', 'Sao Paulo', 'SP',
                    '01234567', 8)
            ->create();
    } catch (Exception $e) {
        dd($e->__toString());
    }
    try {

        $order = $moip->orders()->setOwnId(uniqid())
            ->addItem("bicicleta 1",1, "sku1", 10000)
            ->addItem("bicicleta 2",1, "sku2", 11000)
            ->addItem("bicicleta 3",1, "sku3", 12000)
            ->addItem("bicicleta 4",1, "sku4", 13000)
            ->addItem("bicicleta 5",1, "sku5", 14000)
            ->addItem("bicicleta 6",1, "sku6", 15000)
            ->addItem("bicicleta 7",1, "sku7", 16000)
            ->addItem("bicicleta 8",1, "sku8", 17000)
            ->addItem("bicicleta 9",1, "sku9", 18000)
            ->addItem("bicicleta 10",1, "sku10", 19000)
            ->setShippingAmount(3000)->setAddition(1000)->setDiscount(5000)
            ->setCustomer($customer)
            ->create();

    } catch (Exception $e) {
        dd($e->__toString());
    }

    try {

        // CARTÃO DE CRÉDITO DIRETO (SÓ COM CERTIFICAÇÃO PCI)
        // $payment = $order
        //             ->payments()
        //             ->setCreditCard(request()->cc_exp_month, request()->cc_exp_year, request()->cc_number, request()->cc_cvc, $customer)
        //             ->setInstallmentCount(request()->prestacoes)
        //             ->execute();


        // CARTÃO DE CRÉDITO COM HASH
        $payment = $order->payments()
                    ->setCreditCardHash(request()->hash, $customer)
                    ->setInstallmentCount(3)
                    ->setStatementDescriptor('teste de pag')
                    ->execute();


        // PAGAMENTO EM BOLETO                   
        // $logo_uri = 'https://cdn.moip.com.br/wp-content/uploads/2016/05/02163352/logo-moip.png';
        // $expiration_date = new DateTime();
        // $instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
        // $payment = $order->payments()  
        //     ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
        //     ->execute();

        // dd($payment);

        \Session::flash('mensagem_sucesso','Você efetuou a compra com sucesso, segue o código da sua transação: <span class="bg-dark text-white"> '. $order->getId().'</span>');
          
        return redirect('checkout');
        
    } catch (Exception $e) {
        dd($e->__toString());
    }
})
->name('validar');

Route::get('/checkout', function(){
    return view('checkout');
    
})
->name('checkout');


Route::get('/consultar', function(){

    $moip = Moip::start();
    /* código do pagamento */
    $order = $moip->orders()->get('ORD-H0UW9N0EKQLQ');
    /*
    $order->getId()
    $order->getOwnId()
    $order->getAmountTotal()
    $order->getAmountFees()
    $order->getAmountRefunds()
    $order->getAmountLiquid()
    $order->getAmountOtherReceivers()
    $order->getCurrenty()
    $order->getSubtotalShipping()
    $order->getSubtotalAddition()
    $order->getSubtotalDiscount()
    $order->getSubtotalItems()
    $order->getItemIterator()
    $order->getCustomer()
    $order->getPaymentIterator()
    $order->getReceiverIterator()
    $order->getEventIterator()
    $order->getRefundIterator()
    $order->getStatus()
    $order->getCreatedAt()
    $order->getUpdatedAt()
    $order->getCheckoutPreferences()
    $order->getList()
    */

    return view('consultar', ['consulta' => $order]);
})
->name('consultar');