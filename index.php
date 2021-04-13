<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<?php
    include "./database/database.php";
    $db = new database();
?>

<h2>Reservingen</h2>

<table>
  <tr>
    <th>Tafel</th>
    <th>Datum</th>
    <th>Tijd</th>
    <th>Klant</th>
    <th>Aantal</th>
    <th>Status</th>
    <th>Creation time</th>
    <th>edit</th>
    <th>delete</th>
  </tr>
  <?php
    
    $reservations = $db->select("SELECT 
        reservering.tafel, 
        reservering.datum, 
        reservering.tijd,
        klanten.naam as klantenNaam,
        reservering.aantal,
        reservering.status,
        reservering.datum_toegevoegd,
        reservering.id
        FROM reservering 
        INNER JOIN klanten on klanten.id = reservering.klant_id", []
    );

    print_r($reservations);

    foreach($reservations as $reservation) {
        $tafel = $reservation['tafel'];
        $datum = $reservation['datum'];
        $tijd = $reservation['tijd'];
        $klant = $reservation['klantenNaam'];
        $aantal = $reservation['aantal'];
        $status = $reservation['status'];
        $creationTime = $reservation['datum_toegevoegd'];
        $reservationId = $reservation['id'];

        $EDIT_LINK = "./reservation-edit.php?reservationId=$reservationId";
        $DELETE_LINK = "./reservation-delete.php?reservationId=$reservationId";
        
        echo "
        <tr>
            <td>$tafel</td>
            <td>$datum</td>
            <td>$tijd</td>
            <td>$klant</td>
            <td>$aantal</td>
            <td>$status</td>
            <td>$creationTime</td>
            <td>
                <a href='$EDIT_LINK'>Edit</a>
            </td>
            <td>
                <a href='$DELETE_LINK'>Delete</a>
            </td>
        </tr>
        ";
    }
  ?>
</table>

<a href="./reservation-create.php">Create Reservation</a>

<h2>Customers</h2>

<table>
  <tr>
    <th>naam</th>
    <th>telefoon</th>
    <th>email</th>
  </tr>
  <?php
    
    $customers = $db->select("SELECT * FROM klanten", []);

    foreach($customers as $customer) {
        $naam = $customer['naam'];
        $telefoon = $customer['telefoon'];
        $email = $customer['email'];
        $customerId = $customer['id'];

        $EDIT_LINK = "./customer-edit.php?customerId=$customerId";
        $DELETE_LINK = "./customer-delete.php?customerId=$reservationId";
        echo "
        <tr>
            <td>$naam</td>
            <td>$telefoon</td>
            <td>$email</td>
            <td>
                <a href='$EDIT_LINK'>Edit</a>
            </td>
            <td>
                <a href='$DELETE_LINK'>Delete</a>
            </td>
        </tr>
        ";
    }
  ?>
</table>
<h2>menu items</h2>



<table>
  <tr>
    <th>code</th>
    <th>naam</th>
    <th>gerechtsoort</th>
  </tr>
  <?php
    
    $menuItems = $db->select("SELECT menuitems.naam, menuitems.code, menuitems.id, gerechtsoorten.naam AS gerechtsoortName
    FROM menuitems
    INNER JOIN gerechtsoorten ON gerechtsoorten.id = menuitems.gerechtsoort_id
    WHERE gerechtsoorten.code = 'dri' ", []);

    foreach($menuItems as $menuItem) {
        $code = $menuItem['code'];
        $naam = $menuItem['naam'];
        $gerechtsoortName = $menuItem['gerechtsoortName'];
        $menuItemId = $menuItem['id'];

        // $EDIT_LINK = "./customer-edit.php?customerId=$customerId";
        // $DELETE_LINK = "./customer-delete.php?customerId=$reservationId";
        echo "
        <tr>
            <td>$code</td>
            <td>$naam</td>
            <td>$gerechtsoortName</td>
            <td>
                <!--  <a href='$EDIT_LINK'>Edit</a> -->
            </td>
            <td>
              <!--  <a href='$DELETE_LINK'>Edit</a> -->
            </td>
        </tr>
        ";
    }
  ?>
</table>
</body>
</html>
