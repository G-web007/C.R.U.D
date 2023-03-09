<?php
session_start();
function data_validation($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function successAlert()
{
    if(isset($_SESSION["successMessage"]))
    {
        $message = "<div class=\"alert alert-success text-dark text-center alert-dismissible\">";
        $message .= "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>";
        $message .= "<strong>Success!</strong> " . htmlentities($_SESSION["successMessage"]);
        $message .= "</div>";
        $_SESSION["successMessage"] = null;
        return $message;
    }
}

function deleteAlert()
{
    if(isset($_SESSION["deleteMessage"]))
    {
        $message = "<div class=\"alert alert-danger text-dark text-center alert-dismissible\">";
        $message .= "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>";
        $message .= "<strong>OoOps!</strong> " . htmlentities($_SESSION["deleteMessage"]);
        $message .= "</div>";
        $_SESSION["deleteMessage"] = null;
        return $message;
    }
}

function requiredAlert()
{
    if(isset($_SESSION["requiredMessage"]))
    {
        $message = "<div class=\"alert alert-danger text-dark text-center alert-dismissible\">";
        $message .= "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>";
        $message .= "<strong>WoOoP!</strong> " . htmlentities($_SESSION["requiredMessage"]);
        $message .= "</div>";
        $_SESSION["requiredMessage"] = null;
        return $message;
    }
}

?>