<?php
    include('inc/css.php');
    // Preventing the direct access of this page.
    if(!isset($_REQUEST['id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM agents WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }
    
    // Delete from agents
    $statement = $pdo->prepare("DELETE FROM agents WHERE id=?");
    $statement->execute(array($_REQUEST['id']));

    header('location: view-agents.php');
?>