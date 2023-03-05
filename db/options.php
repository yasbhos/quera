<?php

function get_option($option_name, $full_row = false)
{
    if (!$option_name) {
        return null;
    }

    global $db_conn;
    $result = $db_conn->query("
        SELECT *
        FROM options
        WHERE option_name = '$option_name'
    ");

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if ($full_row) {
            return $row;
        } else {
            return $row['option_value'];
        }
    } else {
        return null;
    }
}

function option_exists($option_name): bool
{
    $row = get_option($option_name, true);
    return isset($row['id']);
}

function add_option($option_name, $option_value = null): void
{
    if (!$option_name) {
        return;
    }

    if (!$option_value) {
        $option_value = '0';
    }

    global $db_conn;

    if (!option_exists($option_name)) {
        $db_conn->query("
            INSERT INTO options (option_name, option_value) VALUES
            ('$option_name', '$option_value');
        ");
    } else {
        $db_conn->query("
            UPDATE options
            SET option_value = '$option_value'
            WHERE option_name = '$option_name';
        ");
    }
}

function update_option($option_name, $option_value = null): void
{
    add_option($option_name, $option_value);
}

function delete_option($option_name): void
{
    if (!option_exists($option_name)) {
        return;
    }

    global $db_conn;
    $db_conn->query("
        DELETE FROM options
        WHERE option_name = '$option_name';
    ");
}