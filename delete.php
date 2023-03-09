<?php 

require_once("connect.php");
require_once("function.php");

if(isset($_GET["id"]))
{
    $id = htmlentities($_GET["id"]);
    $sql = "DELETE FROM `user` WHERE `id`='$id'";
    $conn->exec($sql);
    $_SESSION["deleteMessage"] = "Data is deleted";
    header("Location: index.php");
}
?>