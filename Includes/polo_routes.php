<?php
// Gancho para adicionar menus de administrador
add_action('admin_menu', 'mt_add_pages');

// função de ação para o gancho acima
function mt_add_pages() {
    // Adicione um novo submenu em Configurações:
    add_options_page(__('cadastrar polos','menu-polo'), __('Cadastrar Polos','menu-polo'), 'manage_options', 'polosettings', 'mt_settings_page');


    // Adicionar um novo menu de nível superior (desaconselhável):
    add_menu_page(__('polo Educacionais','menu-polo'), __('polos Educacionais','menu-polo'), 'manage_options', 'mt-top-level-handle', 'mt_toplevel_page' );

    
}
// mt_toplevel_page() exibe o conteúdo da página para o menu de nível superior do polo personalizado
function mt_toplevel_page() {
    require_once plugin_dir_path(__FILE__) . '/polos_dashboard.php';
}





?>
