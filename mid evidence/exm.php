<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manufacturer and Product Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    fieldset {
        width: 25%;
        margin: 0 auto; /* Center the fieldset */
		border-radius: 4px;
    }

    fieldset label {
        display: block;
        margin-bottom: 10px;
    }

    fieldset input[type="text"],
    fieldset select {
        width: calc(100% - 30px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    fieldset input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 15px 25px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    fieldset input[type="submit"]:hover {
        background-color: #45a049;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<?php
$db = new mysqli('localhost','root','','company');

if(isset($_POST['btnSubmit'])){
    $mname = $_POST['mname'];
    $address = $_POST['address']; 
    $contact = $_POST['contact'];
    $db->query("CALL add_manufacturer('$mname','$address','$contact')");
}

if(isset($_POST['addproduct'])){
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $mid = $_POST['manufac'];
    $db->query("CALL add_product('$pname','$price','$mid')"); // Removed single quotes around $price and $mid
}


if(isset($_POST['mdelete'])){
   
    $mid = $_POST['manufac'];
    $db->query("delete from manufacturer where id='$mid'"); 
}
?>
<fieldset>
    <legend><h3>Manufacturer Form</h3></legend>
    <form action="#" method="post">
        <label for="mname">Name:</label>
        <input type="text" name="mname" required>
        <label for="address">Address:</label>
        <input type="text" name="address" required>
        <label for="contact">Contact:</label>
        <input type="text" name="contact" required>
        <input type="submit" name="btnSubmit" value="Submit">
    </form>
</fieldset>

<fieldset>
    <legend><h3>Product Form</h3></legend>
    <form action="#" method="post">
        <label for="pname">Name:</label>
        <input type="text" name="pname" required>
        <label for="price">Price:</label>
        <input type="text" name="price" required>
        <label for="manufac">Manufacturer Name:</label>
        <select name="manufac" required>
            <?php 
                $manufac = $db->query("SELECT * FROM manufacturer");
                while(list($_mid,$_mname) = $manufac->fetch_row()){
                    echo "<option value='$_mid'>$_mname</option>";
                }
            ?>
        </select>
        <input type="submit" name="addproduct" value="Submit">
    </form>
</fieldset>

<fieldset>
    <legend><h3>Product Form</h3></legend>
    <form action="#" method="post">
    
        <label for="manufac">Manufacturer Name:</label>
        <select name="manufac" required>
            <?php 
                $manufac = $db->query("SELECT * FROM manufacturer");
                while(list($_mid,$_mname) = $manufac->fetch_row()){
                    echo "<option value='$_mid'>$_mname</option>";
                }
            ?>
        </select>
        <input type="submit" name="mdelete" value="delete">
    </form>
</fieldset>
<h3>View Product</h3>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact No</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Manufacturer ID</th>
    </tr>

    <?php
    $product = $db->query("SELECT * FROM viewcompanydata");
    while(list($_id,$_name,$_address,$_contact,$_pid,$_pname,$_price,$_manufacturer) = $product->fetch_row()){
        echo "<tr> 
                <td>$_id</td>
                <td>$_name</td>
                <td>$_address</td>
                <td>$_contact</td>
                <td>$_pid</td>
                <td>$_pname</td>
                <td>$_price</td>
                <td>$_manufacturer</td>
            </tr>";
    }
    ?>
</table>
</body>
</html>












