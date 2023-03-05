<?php

function include_all_php_files($dir): void
{
    foreach (glob("$dir/*.php") as $filename) {
        include_once("$filename");
    }
}

function load_module(): void
{
    $module = get_module_name();
    if (empty($module)) {
        $module = "home";
    }

    if (is_user_logged_in() && $module == "login") {
        redirect_to(home_url());
    }

    $module_file = "modules/$module.php";
    if (file_exists($module_file)) {
        require_once("modules/$module.php");
        check_for_authentication_requirement();
    } else {
        require_once("modules/home.php");
    }

    render_page();
}

function get_module_name(): string
{
    $url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $request = str_replace(SITE_URL, "", $url);
    $question_mark_pos = strpos($request, "?");
    if ($question_mark_pos !== false) {
        $request = substr($request, 0, $question_mark_pos);
    }

    return $request;
}

function home_url($path = null): string
{
    if (!$path || $path == "/") {
        return SITE_URL;
    }

    return SITE_URL . $path;
}

function redirect_to($url): void
{
    if (!is_valid_url($url)) {
        return;
    }

    header("Location: $url");
    die();
}

function is_valid_url($url): bool
{
    if (empty($url)) {
        return false;
    }

    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function check_for_authentication_requirement(): void
{
    if (authentication_required() && !is_user_logged_in()) {
        $login_url = home_url("login");
        redirect_to($login_url);
    }
}

function render_page(): void
{
    include_once("templates/header.php");

    if (function_exists("process_inputs")) {
        process_inputs();
    }

    show_messages();

    if (function_exists("get_content")) {
        get_content();
    }

    include_once("templates/footer.php");
}

$messages = array();

function add_message($message = null, $type = "error"): void
{
    if (!$message) {
        return;
    }

    global $messages;
    $messages[] = array(
        "message" => $message,
        "type" => $type
    );
}

function show_messages(): void
{
    global $messages;
    if (empty($messages)) {
        return;
    }

    foreach ($messages as $item) {
        $message = $item["message"];
        $type = $item["type"];
        if ($type == "error") {
            $type = "danger";
        } elseif ($type == "info") {
            $type = "primary";
        }
        ?>
        <div class="alert alert-<?php echo $type; ?> alert-dismissible fade show" role="alert">
            <strong><?php echo $message; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
}