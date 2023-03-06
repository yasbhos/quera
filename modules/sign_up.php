<?php

function authentication_required(): bool
{
    return false;
}

function get_title(): string
{
    return "Sign up";
}

function get_content(): void
{ ?>
    <div class="container text-left">
        <div class="row">
            <div class="col"></div>
            <div class="col-4">
                <form method="post">
                    <div class="mb-3">
                        <label for="signupInputFirstname" class="form-label">First name</label>
                        <input type="text" class="form-control" name="first_name" id="signupInputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="signupInputLastname" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="signupInputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="signupInputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="signupInputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="sign_upInputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="signupInputEmail">
                    </div>
                    <div class="mb-3">
                        <label for="signupInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="signupInputPassword">
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
    if (!isset($_POST["first_name"])) {
        return;
    }

    $first_name = $_POST["first_name"];
    if (empty($first_name)) {
        add_message("Firstname cannot be empty.");
        return;
    }
    $last_name = $_POST["last_name"];
    if (empty($last_name)) {
        add_message("Lastname cannot be empty.");
        return;
    }
    $username = $_POST["username"];
    if (empty($username)) {
        add_message("Username cannot be empty.");
        return;
    }
    $email = $_POST["email"];
    if (empty($email)) {
        add_message("Email cannot be empty.");
        return;
    }

    $password = $_POST["password"];
    if (empty($password)) {
        add_message("Password cannot be empty.");
        return;
    }

    if (user_exists($username)) {
        add_message("Choose another username.");
        return;
    }

    $user = array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    );

    add_user($user);

    add_message("Successfully registered.", "success");
    add_message("You'll be redirected to login page.", "info");
    ?>
    <meta http-equiv="refresh" content="4;url=<?php echo home_url("login"); ?>">
<?php }