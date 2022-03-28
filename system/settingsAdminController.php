<?php
@session_start();
require_once('dbController.php');
require_once "userTypeController.php";

if(isadmin()){ //for admin setting change, we need authorization of admin, so it is not misused

    if(isset($_POST['editSettingsAdmin'])){
        $commission_rate = htmlspecialchars(trim($_POST['rate']));
        $minimum_balance = htmlspecialchars(trim($_POST['minimum_balance']));
        $editSettingsQuery = $pdo->prepare("UPDATE admin_settings SET commission_rate=:commission_rate,minimum_balance=:minimum_balance WHERE setting_id=1");
        $editSettingsQuery->execute([
            ':commission_rate' => $commission_rate,
            ':minimum_balance' => $minimum_balance
        ]); //getting data from the post request, trimming and validating, and then updating database with sql
        header('Location: ../dashboard/admin_settings.php');
    }  
    
}

?>