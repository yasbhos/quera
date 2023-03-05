<?php

$logged_in_user = null;
$logged_in_user_id = null;

function get_logged_in_user(): array
{
    global $logged_in_user;
    return $logged_in_user;
}

function get_logged_in_user_id(): string
{
    global $logged_in_user_id;
    return $logged_in_user_id;
}

function is_user_logged_in(): bool
{
    global $logged_in_user_id;
    if ($logged_in_user_id) {
        return true;
    }
    return false;
}

function check_for_previous_login(): void
{
    $last_access = &$_SESSION['last_access'];
    $expired = ((time() - $last_access) > SESSION_EXPIRATION_TIME);
    if ($expired) {
        clear_user_session();
        return;
    }

    $username = $_SESSION['username'];

    $user = get_user($username);
    if ($user) {
        $user_id = $_SESSION['user_id'];
        if ($user_id != $user['id']) {
            clear_user_session();
            return;
        }

        $password = $_SESSION['password'];
        if ($password != $user['password']) {
            clear_user_session();
            return;
        }

        global $logged_in_user;
        global $logged_in_user_id;

        $logged_in_user = $user;
        $logged_in_user_id = $user['id'];
    }
}

function clear_user_session(): void
{
    unset($_SESSION['last_access']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
}

function user_logout(): void
{
    global $logged_in_user;
    global $logged_in_user_id;

    $logged_in_user = null;
    $logged_in_user_id = null;

    clear_user_session();
}

function user_login($username, $password): void
{
    user_logout();

    $user = get_user($username);
    if (!$user) {
        return;
    }

    if (sha1($password) != $user['password']) {
        return;
    }

    global $logged_in_user;
    global $logged_in_user_id;

    $logged_in_user = $user;
    $logged_in_user_id = $user['id'];

    $_SESSION['last_access'] = time();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $user['password'];

    redirect_to(home_url());
}