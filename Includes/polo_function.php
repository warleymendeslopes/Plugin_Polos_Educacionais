<?php
//função para criar o banco de dados do plugin
function  polo_createdatabases(){
    global $wpdb;

    $prefix = $wpdb->prefix;
    $leads = $prefix . 'polos';

    if ($wpdb->get_var("SHOW TABLES LIKE $leads") != $leads):
        $query =
            "CREATE TABLE $leads (
                id int NOT NULL AUTO_INCREMENT, 
                estado varchar(200) NOT NULL, 
                endereco varchar(200) NOT NULL, 
                cep varchar (30) NOT NULL,
                telefone varchar(200) NOT NULL, 
                whatsapp varchar(200) NOT NULL, 
                nomeresponsavel varchar(200) NOT NULL, 
                email varchar(200) NOT NULL,                 
                primary key(id)
            );";


    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $var = dbDelta($query);
   //var_dump($var); //
    endif;
    //var_dump($wpdb->get_var("SHOW TABLES LIKE $leads"));
 }
//inserir informações no banco de dados
function polocadastrar(){
    if(!empty($_POST['buttom'])){ 
        $polo_estado            =      $_POST['estado'];
        $polo_endereco          =      $_POST['endereco'];
        $polo_cep               =      $_POST['cep'];
        $polo_telefone          =      $_POST['telefone'];
        $polo_whatsapp          =      $_POST['whatsapp'];
        $polo_nomeresponsavel   =      $_POST['nomeresponsavel'];
        $polo_email             =      $_POST['email'];

        global $wpdb;
        $table = $wpdb->prefix.'polos';
        $data = array(
            'estado'           =>      $polo_estado,
            'endereco'         =>      $polo_endereco,
            'cep'              =>      $polo_cep,
            'telefone'         =>      $polo_telefone,
            'whatsapp'         =>      $polo_whatsapp,
            'nomeresponsavel'  =>      $polo_nomeresponsavel,
            'email'            =>      $polo_email         
        );
        //$format = array('%s','%d');
        $wpdb->insert($table,$data);
        $my_id = $wpdb->insert_id;
        }

    }


    
//listar todos os polos cadastrados
function listpolos(){

    global $wpdb;
     $table = $wpdb->prefix.'polos';

     $polo_list = $wpdb-> get_results("SELECT * FROM $table ORDER BY id DESC");
     //echo "<pre>";
     //print_r($polo_list); ?>
     <!-- CSS only -->
        <table class="polo_table">
            <thead>
                <tr>
                <th scope="col">Estado</th>
                <th scope="col">Endereço</th>
                <th scope="col">CEP</th>
                <th scope="col">Telefone</th>
                <th scope="col">Whatsapp</th>
                <th scope="col">Responsavel</th>
                <th scope="col">E-mail</th>
                </tr>
            </thead>
                <tbody><?php
     
                    foreach ($polo_list  as $key => $value) { ?>
                        <tr>
                            <td><?php echo "$value->estado"; ?></td>
                            <td><?php echo "$value->endereco"; ?></td>
                            <td><?php echo "$value->cep"; ?></td>
                            <td><?php echo "$value->telefone"; ?></td>
                            <td><?php echo "$value->whatsapp"; ?></td>
                            <td><?php echo "$value->nomeresponsavel"; ?></td>
                            <td><?php echo "$value->email"; ?></td>
                            <td> 
                                <form method="POST">
                                    <input type="hidden"  id="custId" name="deletarpolo" value="<?php echo "$value->id"; ?>">
                                    <input name="polodelete" type="submit" value="Deletar" style="height: 39px;color: #ffffff;background: #ff3200;border: none;border-radius: 8px;">
                                </form> 
                            </td>
                            <td> 
                                <form method="POST">
                                    <input type="hidden"  id="custId" name="editarpolo" value="<?php echo "$value->id"; ?>">
                                    <input class="editepolo" name="buttoneditarpolo" type="submit" value="Editar" style="height: 39px;color: #ffffff;background: #003bab;border: none;border-radius: 8px;">
                                </form> 
                            </td>
                            
                        </tr><?php    }    ?>
                </tbody>
                
        </table><?php polo_delet();
        

 }
// Exibira os dados dos polos na pagina com o shortcode 
function poloshortcode(){ ?>


    <style>
        #polosContaner{
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            max-width: 95%;
            margin: 0 auto;

        }
        .polo_info{
            flex: 1 1 500px;
            width: 400px;
            height: 250px;
            background: #ececec;
            border-radius: 5px;
            margin: 10px;
        }
        .polo_estado{
            padding: 17px;
            font-size: 24px;
            font-weight: 600;
            color: #777777;
        }
        .polocontato{
            display: grid;
            grid-template-columns: 80% 20%;
        }
        .polocontato> ul {
            list-style-type: none;
            margin: 0px;
            color: black;
            font-weight: 100;
            font-size: 19px;
        }
        .whats{
            position: relative;
            grid-column-end: 3;
            grid-row-end: 3;
            align-items: center;
            text-align: center;
            color: green;
        }
        .whats>a{
            align-items: center;
            text-align: center;
            color: green;
        }


    </style>

    <div id="polosContaner">
        <?php 
                global $wpdb;
                $table = $wpdb->prefix.'polos';
           
                $polo_list = $wpdb-> get_results("SELECT * FROM $table ORDER BY id DESC");
                foreach ($polo_list  as $key => $value) { 
        ?>

        <div class="polo_info">
            <span class="polo_estado"><?php echo "$value->estado"; ?></span>
                <div class="polocontato">
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg> <?php echo "$value->endereco"; ?></li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                            </svg> <?php echo "$value->cep"; ?></li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                            </svg> <?php echo "$value->telefone"; ?></li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg> <?php echo "$value->nomeresponsavel"; ?></li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                            <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z"/>
                            </svg> <?php echo "$value->email"; ?></li>
                    </ul>

                    <?php
                    $polo_whatsp = $value->whatsapp;
                    $polo_link_whats = "https://api.whatsapp.com/send?phone=55".$polo_whatsp;

                     //echo $polo_whatsp;
                    if($polo_whatsp){

                        
                        ?>
                         
                         <span class="whats"><a href="<?php echo $polo_link_whats; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                            </svg> </a>
                    </span>
                        <?php
                    }
                    ?>

                    
                </div>
        </div>     
        
        <?php    }    ?>
    </div><!--fim do polosContaner-->

           
 <?php }
//apagar 
function polo_delet(){

    if(!empty($_POST['polodelete'])){
       global $wpdb;
       $table = $wpdb->prefix.'polos';
        $id = $_POST['deletarpolo'];
       $wpdb->delete( $table, array( 'id' => $id ) );
       
    }
}
//editar polos cadastrados
function verificapoloselecionado(){
    if(!empty($_POST['buttoneditarpolo'])){
        global $wpdb;
        $table = $wpdb->prefix.'polos';
         $id = $_POST['editarpolo'];
         $id_polo_edite = $id;
         $polo_list_update = $wpdb-> get_results("SELECT * FROM $table WHERE id= $id");
         foreach ($polo_list_update  as $key => $value) {
             //echo $value->estado;
         }
         return $id_polo_edite;


     }

 }
//função para editar os polos 
function editar_polos_educacionais(){
    if (!empty($_POST['edite_submit_polo'])) {
        $where_udate                   =      $_POST['where_update'];
        $polo_estado_editar            =      $_POST['estado'];
        $polo_endereco_editar          =      $_POST['endereco'];
        $polo_cep_editar               =      $_POST['cep'];
        $polo_telefone_editar          =      $_POST['telefone'];
        $polo_whatsapp_editar          =      $_POST['whatsapp'];
        $polo_nomeresponsavel_editar   =      $_POST['nomeresponsavel'];
        $polo_email_editar             =      $_POST['email'];

        global $wpdb;
        $table = $wpdb->prefix.'polos';
        $data_edite = array(
            'estado'           =>      $polo_estado_editar,
            'endereco'         =>      $polo_endereco_editar,
            'cep'              =>      $polo_cep_editar,
            'telefone'         =>      $polo_telefone_editar,
            'whatsapp'         =>      $polo_whatsapp_editar,
            'nomeresponsavel'  =>      $polo_nomeresponsavel_editar,
            'email'            =>      $polo_email_editar         
        );

        
        $wpdb->update($table, $data_edite, array('id'=>$where_udate ));
    }


}

polo_delet();








