<?php
    include "./database/database.php";
    $db = new database();
    $id =  $_GET['reservationId'];

    $db->update_or_delete('DELETE FROM `reservering` WHERE id=:poop', [
        'poop'=> $id
    ]);
 
    echo 'Reservation Deleted';
?>