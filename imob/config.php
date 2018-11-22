<?php

/** O nome do banco de dados*/
define('DB_NAME', 'ImobV9');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'sine903');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', '/imob/');

/** caminhos dos templates de header e footer **/
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('HEADER_TEMPLATE_TEST', ABSPATH . 'inc/header.1.php');
define('HEADERADM_TEMPLATE', ABSPATH . 'inc/headeradm.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
