<?php
$conn = mysqli_connect('localhost', 'root', '', 'company');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $manufacturer_name = $_POST['manufacturer_name'];
    $manufacturer_address = $_POST['manufacturer_address'];
    $manufacturer_contact = $_POST['manufacturer_contact'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Insert data into Manufacturer table
    $manufacturer_query = "INSERT INTO Manufacturer (name, address, contact_no) VALUES ('$manufacturer_name', '$manufacturer_address', '$manufacturer_contact')";
    if(mysqli_query($conn, $manufacturer_query)) {
        // Get the last inserted manufacturer_id
        $manufacturer_id = mysqli_insert_id($conn);

        // Insert data into Product table
        $product_query = "INSERT INTO Product (name, price, manufacturer_id) VALUES ('$product_name', $product_price, $manufacturer_id)";
        if(mysqli_query($conn, $product_query)) {
            echo "Data inserted successfully into both tables.";
        } else {
            echo "Error inserting data into Product table: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting data into Manufacturer table: " . mysqli_error($conn);
    }
}

// Fetch Manufacturer data
$manufacturer_data = mysqli_query($conn, "SELECT * FROM Manufacturer");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        fieldset {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        legend {
            font-weight: bold;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <form method="post">
        <fieldset>
            <legend>Manufacturer Information</legend>
            <label for="manufacturer_name">Manufacturer Name:</label>
            <input type="text" id="manufacturer_name" name="manufacturer_name"><br>
            <label for="manufacturer_address">Address:</label>
            <input type="text" id="manufacturer_address" name="manufacturer_address"><br>
            <label for="manufacturer_contact">Contact:</label>
            <input type="text" id="manufacturer_contact" name="manufacturer_contact"><br>
        </fieldset>
        <fieldset>
            <legend>Product Information</legend>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name"><br>
            <label for="product_price">Product Price:</label>
            <input type="text" id="product_price" name="product_price"><br>
        </fieldset>
        <input type="submit" name="submit" value="Submit">
    </form>
    
    <h2>Manufacturer Data</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($manufacturer_data)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['contact_no']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
