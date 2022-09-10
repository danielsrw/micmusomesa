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
        $statement = $pdo->prepare("SELECT * FROM properties WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }
?>

<?php
    // Getting photo ID to unlink from folder
    $statement = $pdo->prepare("SELECT * FROM properties WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $featured_photo = $row['featured_photo'];
        unlink('../assets/uploads/properties/'.$featured_photo);
    }

    // Getting other photo ID to unlink from folder
    $statement = $pdo->prepare("SELECT * FROM property_photos WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $photo = $row['photo'];
        unlink('../assets/uploads/property_photos/'.$photo);
    }

    // Delete from tbl_photo
    $statement = $pdo->prepare("DELETE FROM properties WHERE id=?");
    $statement->execute(array($_REQUEST['id']));

    // Delete from property_photos
    $statement = $pdo->prepare("DELETE FROM property_photos WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));

    // Delete from property_features
    $statement = $pdo->prepare("DELETE FROM property_features WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));

    // Delete from property_types
    $statement = $pdo->prepare("DELETE FROM property_types WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));

    // Delete from property_agent
    $statement = $pdo->prepare("DELETE FROM property_agent WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));

    header('location: view-property.php');
?>