<?php
include __DIR__ . "/header.php";
?>

<div id="conteudo">
    <h2>C.R.U.D.</h2>
    <div id="msg-php" class="no-display"></div>

    <form 
    method="POST" 
    enctype="multipart/form-data" 
    onSubmit="salvarForm(); return false;" 
    id="frmCrud"
    data-on-success-redirect="./carregar_lista.php"
    >
        <fieldset>
            <legend>Nome:</legend>
            <input id="nome" type=text class=input-text required placeholder="Digite seu nome aqui" size=20 name=nome
                onFocus="inputOn(this)" onBlur="inputOff(this)" />
            <legend>Email:</legend>
            <input id="email" type=email class=input-text required placeholder="Informe seu email" size=30 name=email
                onFocus="inputOn(this)" onBlur="inputOff(this)" />
            <legend>Telefone:</legend>
            <input id="telefone" type=text class=input-text required pattern="\d*"
                placeholder="Insira seu telefone (apenas números)" size=10 name=telefone onFocus="inputOn(this)"
                onBlur="inputOff(this)" />
        </fieldset>
        <fieldset>
            <!-- <legend>Foto:</legend>
        <input type=file id="foto" name=foto class=input-text accept="image/png, image/jpeg"/>
        <img id="image" class=thumb /> -->
        </fieldset>
        <input id="id" type=hidden value="-1" />
        <input id="nomeFoto" type=hidden value="" />

        <div class="">
            <input type=reset class=button id="btnLimpar" value="Limpar" />
            <input type=submit class=button style="margin-right: 420px" id="btnSalvar" value="Salvar" />
        </div>
    </form>
</div>

<div id="lista">
    <script type="text/javascript">carregarLista();</script>
</div>

<?php
include __DIR__ . "/footer.php";
?>