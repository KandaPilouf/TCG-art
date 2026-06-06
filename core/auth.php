<?php
function require_admin(): void{
    if($_SESSION['is_admin'] != 1){
        redirect("/login");
    }
}

function require_connected(): void{
    if($_SESSION['is_connected'] != 1){
        redirect("/login");
    }
}
?>