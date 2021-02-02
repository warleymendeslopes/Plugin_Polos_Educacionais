<?php
/*
* Plugin Name: Polos Educacionais
*Author Name: Warley Mendes - GrupoProminas
*Author URI: grupoprominas.com.br
*Description: Plugin desenolvido para realizar cadastro de Polos educacionais 
*Version: 1.0
*/
if(!defined('ABSPATH')){
    die('invalid request.');
}

require_once plugin_dir_path(__FILE__) . 'includes/polo_routes.php';
require_once plugin_dir_path(__FILE__) . 'includes/polo_function.php';


add_shortcode( 'poloead', 'poloshortcode' );