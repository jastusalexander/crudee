<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        table {
          
         
          border: 1px solid black; /* Add a border around the entire table */
        }
        
        th, td {
          border: 1px solid black; /* Add borders to table cells */
          padding: 8px;
          text-align: left;
        }
        
        th {
          background-color: #f2f2f2; /* Add a background color to header cells */
        }
      </style>
    <title>dealer</title>
</head>
<body>
    <?php

    $host = "localhost"; // Change this to your database host
    $dbname = "dealer"; // Change this to your database name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password


    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    if(!$pdo){
        echo "Connection to database failed!";
        die;
    }
    

    $sql = "SELECT * FROM users";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $userRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    ?>



    <table>
        
        <th>
            No.
        </th>
        <th>
            Name
        </th>
        <th>
            Phone Number
        </th>
        <th>
            Email
        </th>
        <th>
            Address
        </th>
        <th colspan="2">
            Action
        </th>
        <?php

            foreach($userRows as $user){
                $address = $user['address'];
                $name = $user['name'];
                $number = $user['number'];
                $email = $user['email'];
                $No = 1;
                $update = '<a href="update.php">Update</a>';
                $delete = '<a href="delete.php">Delete</a>';
                echo "<tr>";

                    echo "<td>";
                        echo $No;
                    echo "</td>";

                    echo "<td>";
                        echo $name;
                    echo "</td>";

                    echo "<td>";
                        echo $number;
                    echo "</td>";

                    echo "<td>";
                        echo $email;
                    echo "</td>";

                    echo "<td>";
                        echo $address;
                    echo "</td>";

                    echo "<td>";
                        echo $update;
                    echo "</td>";

                    echo "<td>";
                        echo $delete;
                    echo "</td>";

                echo "</tr>";
                $No = $No + 1;
            }

        ?>
        
    </table><br>
    <a href="insert.php"> <button>Add User</button> </a>



    
</body>
</html>

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con-pass'];

    // Basic validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Assuming you have a database connection
        $db_host = "your_host";
        $db_user = "your_username";
        $db_pass = "your_password";
        $db_name = "your_database_name";

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Assuming you have a users table
        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>