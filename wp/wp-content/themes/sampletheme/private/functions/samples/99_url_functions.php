<?php

function get_current_uri()
{
    $scheme = is_ssl() ? 'https' : 'http';

    return "$scheme://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
}
