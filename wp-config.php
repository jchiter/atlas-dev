<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'atlas-dev' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'atlas-dev' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'XG1GvkYvgw1g' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'H%&-ls/`Kbs-Zq6bHGTb|nRb,Hv*G@DqzVcG-DMF &YY04:uw)aPv,9Dal&~~Ac;' );
define( 'SECURE_AUTH_KEY',  'bC0DIUnmf-qH;LntK3:&z3z8`g.a#8v5}5m!fbyZjkgUIKKb<NgVn;a i7IFoIa3' );
define( 'LOGGED_IN_KEY',    'SSg/H[_]+dg<H2Nm?RT?ul +AnI!-{6|V>Hj|NW+q0.cR~A5-n<tjD2D~nk_UD*F' );
define( 'NONCE_KEY',        ':`f gC^0/B,h.P#X?.!w[So)rpG2VLcevj%wBzT}7`1fEx| .~z |&l8T+{0deG*' );
define( 'AUTH_SALT',        'S hs,q8m!d-YOD~X<`GChgf6o/K,{n+,Cj?57{L/dPm~%%XX`H|g4_z jKtFwwRt' );
define( 'SECURE_AUTH_SALT', 'BwM5e0/@g0rHxeAma<:Tj hUEsFkzuaAfmc#y|SU<aSM,i4Q5RqEr$+Wk49|?X3x' );
define( 'LOGGED_IN_SALT',   '~q/#J90bG,BSzRg(gBJg1-LVQ0{=@mKfZ^I+cN{:|+@r[e~H](=yz;o=Q+ZBSouW' );
define( 'NONCE_SALT',       ')SRYzM[779.4wCLl5Hd%} e_5mN+;?6?Vn?Tb{A|B2i4r0GZ+4m~JyC1ug!T|=PS' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );

if (is_admin()) {
	add_filter ('filesystem_method', create_function('$a', 'return "direct";'));
	define('FS_CHMOD_DIR', 0775);
}
