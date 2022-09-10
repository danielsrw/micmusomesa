<?php
    include('inc/css.php');
    include('controllers/PropertyController.php');
?>

<?php
    // Preventing the direct access of this page.
    if(!isset($_REQUEST['id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM types WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }
?>

<?php
// Delete from types
$statement = $pdo->prepare("DELETE FROM types WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: view-property-type.php');
?>