<?php
    include "./database/database.php";
    $db = new database();
    // localhost/final-exam/customer-delete.php?customerId=50
    // then $id = 50
    $id = $_GET['customerId'];

    $db->update_or_delete('DELETE FROM `klant` WHERE id=:customerId', [
        'customerId'=> $id
    ]);
 
    echo 'Reservation Deleted';
?>