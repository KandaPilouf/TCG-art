<?php
function require_admin(): void{
    if($_SESSION['is_admin'] != 1){
        redirect("/login");
    }
}
?>