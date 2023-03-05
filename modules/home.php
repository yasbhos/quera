<?php

function authentication_required(): bool
{
    return false;
}

function get_title(): string
{
    return "Home";
}

function get_content(): void
{ ?>
    <div class="container text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <h1>Quera is a learning management system (LMS) developed by yasbhos.</h1>
                <a href="https://github.com/yasbhos/quera">Github repository</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
<?php }