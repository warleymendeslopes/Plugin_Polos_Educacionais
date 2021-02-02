<?php
require_once plugin_dir_path(__FILE__) . '/polo_function.php';
polo_createdatabases();
polocadastrar();
editar_polos_educacionais();



?>

<head>
<link rel="stylesheet" type="text/css" href="CSS/style.css" />
<style>
.polo_container{
    display: grid;
    grid-template-columns: 35% 65%;
}
.polo_table {
    padding: 51px;
    text-align: center;
}

</style>
</head>

<body>
<div class="polo_container">
<?php 
if(verificapoloselecionado() == NULL){ ?>
    <form class="newcadastropolo" method="POST" style="width: 100%;">
<h1 class="polo_title">Cadastrar Polos Educacionais.</h1>
    <div class="polo-input-group" style="display:grid;">
        <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Estado:</label>
        <input placeholder="Estado" name="estado" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for="" style="font-size: 17px; color: #6b6c75;font-weight: 300;">Endereço:</label>
        <input placeholder="Rua, numero, Complemento " name="endereco" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for="" style="font-size: 17px; color: #6b6c75;font-weight: 300;">CEP:</label>
        <input placeholder="informe o CEP" name="cep" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Telefone:</label>
        <input   placeholder="Telefone Fixo" name="telefone"style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;" type="number" id="phone" name="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" />
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Whatsapp:</label>
        <input   placeholder="Whatsapp de contato do polo" name="whatsapp"style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;" type="number" id="phone" name="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" />
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Nome Representante:</label>
        <input placeholder="Nome do Representante" name="nomeresponsavel" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">E-mail:</label>
        <input placeholder="E-mail de contato" name="email" type="email" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
    </div>

    <div class="polo-input-group" style="display:grid;margin-top: 12px;">
        <input name="buttom" type="submit" value="Cadastrar Polo" style="height: 39px;color: #4e5256;text-align: center;align-items: center;background: #deffde;border: 1px solid green;border-radius: 8px;font-size: 21px;"">
    </div>


</form>

<?php }else{
    global $wpdb;
    $table = $wpdb->prefix.'polos';
    $id_editar_polo = verificapoloselecionado();
    $polo_list_update = $wpdb-> get_results("SELECT * FROM $table WHERE id= $id_editar_polo");
    foreach ($polo_list_update  as $key => $value) {
        $editar_estado           =   $value->estado;
        $editar_endereco         =   $value->endereco;
        $editar_cep              =   $value->cep;
        $editar_telefone         =   $value->telefone;
        $editar_whatsapp         =   $value->whatsapp;
        $editar_nomeresponsavel  =   $value->nomeresponsavel;
        $editar_email            =   $value->email;
    }
    ?>
    
    <form method=POST>
    <?php echo "Você esta editando o polo de Código: ". $id_editar_polo; ?>
        <h1 class="polo_title">Editar Polo Educacional.</h1>
            <div class="polo-input-group" style="display:grid;">
                <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Estado:</label>
                <input name="where_update" type="hidden" value="<?php echo $id_editar_polo; ?>">
                <input value="<?php echo $editar_estado; ?>" name="estado" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for="" style="font-size: 17px; color: #6b6c75;font-weight: 300;">Endereço:</label>
                <input value="<?php echo $editar_endereco; ?>" name="endereco" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for="" style="font-size: 17px; color: #6b6c75;font-weight: 300;">CEP:</label>
                <input value="<?php echo $editar_cep; ?>" name="cep" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Telefone:</label>
                <input   value="<?php echo $editar_telefone; ?>" name="telefone"style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;" type="number" id="phone" name="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" />
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Whatsapp:</label>
                <input   value="<?php echo $editar_whatsapp; ?>" name="whatsapp"style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;" type="number" id="phone" name="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" />
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">Nome Representante:</label>
                <input value="<?php echo $editar_nomeresponsavel; ?>" name="nomeresponsavel" type="text" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
            </div>

            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <label for=""style="font-size: 17px; color: #6b6c75;font-weight: 300;">E-mail:</label>
                <input value="<?php echo $editar_email; ?>" name="email" type="email" style="height: 39px; padding: 16px; margin-top: 5px; color: #4e5256;">
            </div>


            <div class="polo-input-group" style="display:grid;margin-top: 12px;">
                <input name="edite_submit_polo" type="submit" value="Editar Polo" style="height: 39px;color: #4e5256;text-align: center;align-items: center;background: #deffde;border: 1px solid green;border-radius: 8px;font-size: 21px;"">
            </div>

    
    </form>
<?php }








?>




  <?php 
  //exibir lista dos polos cadastrados no menu de configuração do wordpress
  listpolos();

  polo_delet();

 
  
  

  ?>








</div>
    
</body>
</html>


