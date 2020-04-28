<?php

function user_is_logged()
{
    return (
        isset($_SESSION['logged_user'])
        &&
        $_SESSION['logged_user'] !== ''
    );
}

function redirect($url, $close_session = true)
{
    header('Location: ' . $url);
    if ($close_session) {
        session_write_close();
    }
    exit;
}
