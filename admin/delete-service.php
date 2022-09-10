<?php
    include('inc/css.php');
    include('controllers/ServicesController.php');
?>

<?php
    // Preventing the direct access of this page.
    if(!isset($_REQUEST['id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM services WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }
?>

<?php
    // Delete from services
    $statement = $pdo->prepare("DELETE FROM services WHERE id=?");
    $statement->execute(array($_REQUEST['id']));

    header('location: view-services.php');
?>