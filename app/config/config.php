<?php

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);

/* SYSTEM CONFIG */
define('BASE_URL', "/mnmit");
define('TELEGRAM_BOT_API_KEY', "480509858:AAFmwcoi7r30AVuzs73yJd38ExqA9rPeXKU");
define('EMAIL_MASTER', "jorge_miguelcga@hotmail.com");
define('SENDGRID_API_KEY', "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");

/* DB CONFIG */
define('DBDRIVER', "mysql");
define('SQLITE_DB', "gerenciamento.db");
define('MYSQL_HOST', "localhost");
define('MYSQL_DB', "mnmit_20180721");
define('MYSQL_USER', "root");
define('MYSQL_PASSWORD', "");
define('MYSQL_CHARSET', "utf8");
define('MYSQL_COLLATION', "utf8_unicode_ci");
define('MYSQL_PORT', "3306");