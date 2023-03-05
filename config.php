<?php

const APP_TITLE = "Quera";

include_once("lib/functions.php");

include_all_php_files("lib");
include_all_php_files("db");

create_db_tables();

initialize_users();