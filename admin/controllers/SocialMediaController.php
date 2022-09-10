<?php

    if (isset($_POST['update'])) {
        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['facebook'],'Facebook'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['twitter'],'Twitter'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['instagram'],'Instagram'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['youtube'],'Youtube'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['whatsapp'],'Whatsapp'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['linkedin'],'LinkedIn'));

        $success_message = 'Social Media URLs are updated successfully.';
    }

    $statement = $pdo->prepare("SELECT * FROM social_media");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        if($row['name'] == 'Facebook') {
            $facebook = $row['url'];
        }

        if($row['name'] == 'Twitter') {
            $twitter = $row['url'];
        }

        if($row['name'] == 'Instagram') {
            $instagram = $row['url'];
        }

        if($row['name'] == 'Youtube') {
            $youtube = $row['url'];
        }

        if($row['name'] == 'Whatsapp') {
            $whatsapp = $row['url'];
        }

        if($row['name'] == 'LinkedIn') {
            $linkedin = $row['url'];
        }
    }

?>