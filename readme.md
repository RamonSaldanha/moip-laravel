<h4>Como instalar</h4>
<p>
  IMPORTANTE: LEMBRAR DE USAR O COMANDO VENDOR PUBLISH PARA PUBLICAR OS CONFIGS DO MOIP
  O moip possui uma SDK no github em php com instruções detalhadas de como implementar tudo... 
  <a href="https://github.com/moip/moip-sdk-php">
  https://github.com/moip/moip-sdk-php
  </a><br />
  a questão aqui é a implementação no laravel, neste iremos utilizar o pacote: 
  <a href="https://github.com/artesaos/moip" target="blank">
    https://github.com/artesaos/moip
  </a>, as instruções no github também estão didáticas, só há um problema...<br />
  <h5>Corrigir bug para versões do PHP</h5>
  A versão do pacote moip para laravel está com um erro e só funcionará na versão do PHP 7+, a ideia então é corrigir direto da pasta para que funcione nas demais versões. neste caso, acesse a pasta <span class="badge badge-dark">vendor/artesaos/src/Moip.php</span>(este arquivo só irá aparecer quando você der o composer update).<br />Nele você encontrará uma linha dentro do método start(), a seguinte instrução:

  <pre>
    $this->moip = $this->app->make(Api::class, [$this->app->make(\Moip\Auth\BasicAuth::class, [config('artesaos.moip.credentials.token'), config('artesaos.moip.credentials.key')]), $this->getHomologated()]);
  </pre>

  Substitua para:
  <pre>
    $this->moip = new Api(new \Moip\Auth\BasicAuth(config('artesaos.moip.credentials.token'), config('artesaos.moip.credentials.key')), Api::ENDPOINT_SANDBOX);
  </pre>


</p>
