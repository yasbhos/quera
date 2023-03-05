<?php

function authentication_required(): bool
{
    return false;
}

function get_title(): string
{
    return "Login";
}

function get_content(): void
{ ?>
    <div class="container text-left">
        <div class="row">
            <div class="col"></div>
            <div class="col-4">
                <form method="post">
                    <div class="mb-3">
                        <label for="loginInputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="loginInputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="loginInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="loginInputPassword">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
<?php }

function process_inputs(): void
{
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        return;
    }

    $username = $_POST["username"];
    if (empty($username)) {
        add_message("Username cannot be empty.");
        return;
    }

    $password = $_POST["password"];
    if (empty($password)) {
        add_message("Password cannot be empty.");
        return;
    }

    user_login($username, $password);

    if (!is_user_logged_in()) {
        add_message("The username or password is incorrect.");
    }
}