<?php

function user_count(): int
{
    global $db_conn;
    $results = $db_conn->query("
        SELECT *
        FROM users
    ");

    $counter = 0;
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        $counter++;
    }

    return $counter;
}

function initialize_users(): void
{
    if (user_count() == 0) {
        global $db_conn;
        $default_pw_hash = sha1('admin');
        $db_conn->query("
            INSERT INTO users (username, password, email, first_name, last_name) VALUES
            ('admin', '$default_pw_hash', 'yasbhos@proton.me', '', '');
        ");
    }
}

function get_user($username)
{
    if (!$username) {
        return null;
    }

    global $db_conn;
    $result = $db_conn->query("
        SELECT *
        FROM users
        WHERE username = '$username'
    ");

    return $result->fetch(PDO::FETCH_ASSOC);
}

function user_exists($username): bool
{
    $user = get_user($username);
    return isset($user['id']);
}

function add_user($userdata): void
{
    $username = $userdata['username'];
    if (!$username) {
        return;
    }

    $password = sha1($userdata['password']);
    $email = $userdata['email'];
    $first_name = $userdata['first_name'];
    $last_name = $userdata['last_name'];

    global $db_conn;
    if (!user_exists($username)) {
        $db_conn->query("
            INSERT INTO users (username, password, email, first_name, last_name) VALUES
            ('$username', '$password', '$email', '$first_name', '$last_name');
        ");
    } else {
        $db_conn->query("
            UPDATE users
            SET password = '$password', email = '$email', first_name = '$first_name', last_name = '$last_name'
            WHERE username = '$username';
        ");
    }
}

function update_user($userdata): void
{
    add_user($userdata);
}

function delete_user($username): void
{
    if (!user_exists($username)) {
        return;
    }

    global $db_conn;
    $db_conn->query("
        DELETE FROM users
        WHERE username = '$username';
    ");
}