<?php
    include "./database/database.php";
    $db = new database();

    $customerId = $_GET['customerId'];

    $Customer = $db->select('SELECT * FROM `klanten` WHERE id=:id', [
        'id'=> $CustomerId
    ]);

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $customerCreateSql = "UPDATE `klanten` SET (naam, telefoon, email) VALUES (:naam, :telefoon, :email) WHERE id:id ";

        $customerplaceholder = [ 
            'id'=>$customerId,
            'naam'=>$_POST['naam'],
            'telefoon'=>$_POST['telefoon'],
            'email'=>$_POST['email']
        ];
        $db->add($customerCreateSql ,$customerplaceholder);

        print('added!');
    }
    
    ?>

<h2>Customer Edit</h2>
<?php  
    $naam = $Customer[0]['naam'];
    echo "<input type=text name='naam' placeholder=naam value=$naam required>";
    $telefoon = $Customer[0]['telefoon'];
    echo "<input type=text name='telefoon' placeholder=telefoon value=$telefoon required>";
    $tijd = $Customer[0]['tijd'];
    echo "<input type=text name='tijd' placeholder=tijd value=$tijd required>";
    $email = $Customer[0]['email'];
    echo "<input type=text name='email' placeholder=email value=$email required>";
?>