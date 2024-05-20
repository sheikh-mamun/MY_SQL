<?php 
$conn = mysqli_connect('localhost','root','','crud1');
if (isset($_POST['submit'])){ 
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users(name, age, email) VALUES ('$name','$age','$email')";
    if(mysqli_query($conn, $sql) == TRUE){ 
        echo "DATA INSERTED";
        header('location:view.php');
    } else { 
        echo "Not inserted";
    }
}
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
            background-color: #FFE4C4; /* Background color for the entire page */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 380px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* Background color for the form container */
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        form {
            margin-top: 20px;
            background-color: #00FFFF;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
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
        .view-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
            background-color: #ADD8A6;
        }
    </style>
</head>
<body>
    <div class="container"> 
        <fieldset>
            <legend>User Information</legend>
            <form action="insert.php" method="POST"> 
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <input type="submit" name="submit" value="Insert">
            </form>
            <a href="view.php" class="view-link">View Result</a>
        </fieldset>
    </div>
</body>
</html>
