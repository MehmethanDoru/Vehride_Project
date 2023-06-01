<?php
session_start();

function deleteSessions()
{
    session_unset();
    session_destroy();

    if (empty($_SESSION)) {
        header("Location: reservation.php");
        exit();
    }
}

deleteSessions();
?>