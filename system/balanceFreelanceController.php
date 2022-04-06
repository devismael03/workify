<?php
@session_start();
require_once('dbController.php');
require_once "userTypeController.php";

if(isfreelancer()){

    $userid = $_SESSION['id'];
    if(isset($_POST['addBalance'])){
        $topup = htmlspecialchars(trim($_POST['topup']));
        $getCurrentBalanceQuery = $pdo->prepare("SELECT balance FROM users WHERE id=:uid");
        $getCurrentBalanceQuery->execute(['uid'=>$userid]);
        $getCurrentBalance = $getCurrentBalanceQuery->fetch(PDO::FETCH_ASSOC);
        $modified = intval($getCurrentBalance['balance']) + intval($topup);
        $addBalanceQuery = $pdo->prepare("UPDATE users SET balance=:modified WHERE id=:uid");
        $addBalanceQuery->execute(['modified' => $modified, 'uid' => $userid]);

        $date = date('Y-m-d H:i:s');

        $addTransactionQuery = $pdo->prepare("INSERT INTO transactions(transaction_type,amount,balance_before,balance_after,transaction_time,user_id) VALUES(?,?,?,?,?,?)");
        $addTransactionQuery->execute([2,$topup, $getCurrentBalance['balance'],$modified,$date,$userid]);
        header('Location: ../dashboard/balance_freelancer.php');
    }
    
   
    
}

?>