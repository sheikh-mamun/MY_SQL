<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "myphp";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for error messages
$nameErr = $addressErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Validate and process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $address = test_input($_POST["address"]);
    $gender = test_input($_POST["gender"]);
    $course = test_input($_POST["course"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirmPassword = test_input($_POST["passwordConfirmation"]);

    // Password validation
    if ($password != $confirmPassword) {
        $passwordErr = "Passwords do not match";
    }

    // Insert data into the database if there are no validation errors
    if (empty($passwordErr)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO myphp (name, address, gender, course, email, password)
                VALUES ('$name', '$address', '$gender', '$course', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>User registration successful</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2 class="title">Create a new account</h2>
    <hr>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="John Doe" required>
    <span class="error"><?php echo $nameErr; ?></span>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" placeholder="Enter your area" required>
    <span class="error"><?php echo $addressErr; ?></span>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>

    <label for="course">Course:</label>
    <select id="course" name="course" required>
        <option value="WDPF">WDPF</option>
        <option value="C#">C#</option>
        <option value="JAVA">JAVA</option>
        <option value="DATABASE">DATABASE</option>
        <option value="GRAPIC-DEISGN">GRAPIC-DEISGN</option>
    </select>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>
    <span class="error"><?php echo $emailErr; ?></span>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>
    <span class="error"><?php echo $passwordErr; ?></span>

    <label for="passwordConfirmation">Confirm Password:</label>
    <input type="password" id="passwordConfirmation" name="passwordConfirmation" placeholder="Enter your password" required>
    <span class="error"><?php echo $confirmPasswordErr; ?></span>

    <button type="submit" name="btnSubmit">Create Account</button>
</form>
