<?php

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);

/* SYSTEM CONFIG */
define('BASE_URL', "/mnmit");
define('TELEGRAM_BOT_API_KEY', "INSERT HERE THE KEY");
define('EMAIL_MASTER', "INSERT HERE THE EMAIL");
define('SENDGRID_API_KEY', "INSERT HERE THE KEY");

/* DB CONFIG */
define('DBDRIVER', "mysql");
define('SQLITE_DB', "db_basename.db");
define('MYSQL_HOST', "localhost");
define('MYSQL_DB', "db_name");
define('MYSQL_USER', "db_user");
define('MYSQL_PASSWORD', "db_pass");
define('MYSQL_CHARSET', "utf8");
define('MYSQL_COLLATION', "utf8_unicode_ci");
define('MYSQL_PORT', "3306");