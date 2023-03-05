<?php

session_start();

const SESSION_EXPIRATION_TIME = 24 * 3600;

const APP_TITLE = "Quera";

include_once("lib/functions.php");

include_all_php_files("lib");
include_all_php_files("db");

create_db_tables();

initialize_users();

const SITE_URL = "https://quera.yasbhos/";

check_for_previous_login();