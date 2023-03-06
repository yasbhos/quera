<?php

function authentication_required(): bool
{
    return false;
}

function process_inputs(): void
{
    user_logout();
    redirect_to(home_url("login"));
}