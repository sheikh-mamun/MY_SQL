<?php 
$conn = mysqli_connect('localhost','root','','crud1');
if (isset($_GET['deleteid'])){ 
    $deleteid = $_GET['deleteid'];

     $sql = "DELETE FROM users WHERE id = $deleteid";
     if(mysqli_query($conn, $sql) == TRUE){ 
        header('location:view.php');
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1140px;
            margin: 20px auto;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 2px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        th, td a {
            text-decoration: none;
        }
        th a {
            color: inherit;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
        .btn-success:hover, .btn-danger:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
   <div class="container"> 
    <div class="row"> 
        <div class="col-sm-1"></div>
        <div class="col-sm-10 pt-4 mt-4 border border-success"> 
            <h3 class="text-center p-2 m-2 bg-success text-white">User Information</h3>
            <hr>
            <?php 
            $sql = 'SELECT * FROM users';
            $query = mysqli_query($conn, $sql);
            echo "<table class='table table-success'>
             <tr>
                <th>id</th>
                <th>name</th>
                <th>age</th>
                <th>email</th>
                <th>Action</th>
             </tr>";
           while ($data = mysqli_fetch_assoc($query)){ 
            $id = $data['id'];
            $name = $data['name'];
            $age = $data['age'];
            $email = $data['email'];
            echo "<tr> 
                    <td>$id</td>
                    <td>$name</td>
                    <td>$age</td>
                    <td>$email</td>
                    <td>
                    <span class='btn btn-success'><a href='edit.php?id=$id' class='text-white text-decoration-none'>Edit</a></span>
                    <span class='btn btn-danger'><a href='view.php?deleteid=$id' class='text-white text-decoration-none'>Delete</a></span>
                    </td>
                </tr>";
           }
            ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
   </div>
    <p>
     <a href="insert.php">Add New Information</a>
    </p>
</body>
</html>
