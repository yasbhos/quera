<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        if (function_exists("get_title")) {
            echo get_title();
        } else {
            echo APP_TITLE;
        }
        ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<div class="col-lg-12">
    <nav class="py-2 bg-light border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="<?php echo home_url("home"); ?>" class="nav-link link-dark px-2">Home</a>
                </li>
                <li class="nav-item"><a href="<?php echo home_url("dashboard"); ?>" class="nav-link link-dark px-2">Dashboard</a>
                </li>
            </ul>
            <ul class="nav">
                <?php if (is_user_logged_in()): ?>
                    <li class="nav-item"><a href="<?php echo home_url("logout"); ?>" class="nav-link link-dark px-2">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="<?php echo home_url("login"); ?>" class="nav-link link-dark px-2">Login</a>
                    </li>
                    <li class="nav-item"><a href="<?php echo home_url("sign_up"); ?>" class="nav-link link-dark px-2">Sign
                            up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main>