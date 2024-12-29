<?php
// Include database connection file
@include 'config.php';

// Initialize $startDate and $endDate variables
$startDate = $endDate = "";

// Fetch all data from the "car" and "reservations" tables
$sql = "SELECT c.*, r.* FROM car c
        LEFT JOIN reservations r ON c.car_id = r.car_id
        WHERE r.start_date >= '$startDate' AND r.end_date <= '$endDate' OR r.start_date IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Report</title>
    <style>
        body {
            background: url('img/car 1_2.jpg')  center center fixed;
             font-family: 'Arial', sans-serif;
             margin: 20px;
             background-size: cover;
}

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form {
        text-align: center;
        margin-bottom: 20px;
    }
    .search-form input[type="date"] {
        width: 200px;
        padding:5px; 
        margin-right: 20px;
        box-sizing: border-box;
    }
    .search-form input[type="submit"] {
        width: 120px; 
        padding: 10px; 
        border: none;
        border-radius: 3px;
        background-color: #007bff; 
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .search-form input[type="submit"]:hover {
        background-color: #800080; 
    }

.search-form label {
    margin-right: 10px;
}

        .car-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .car-details {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            cursor: pointer;
            margin: 10px;
        }

        .car-details:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .car-details strong {
            font-weight: bold;
            color: #0056b3;
        }

        .no-cars {
            text-align: center;
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Car Report</h2>

    <form action="" method="post" class="search-form">
    <label for="start_date"><b>Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date"><b>End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <label for="color"><b>Car Color:</label>
    <select id="color" name="color">
        <option value="">Select Color</option>
        <option value="Red">Red</option>
        <option value="Silver">Silver</option>
        <option value="Black">Black</option>

    </select>

    <input type="submit" name="submit" value="Search">
</form>

    <ul class="car-list">
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            
            $sql = "SELECT c.*, r.* FROM car c
                    LEFT JOIN reservations r ON c.car_id = r.car_id
                    WHERE r.start_date >= '$startDate' AND r.end_date <= '$endDate' OR r.start_date IS NULL";
            $result = $conn->query($sql);
        }

        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) {
                $carId = $row['car_id'];
                $carModel = $row['car_model'];
                $carStatus = isset($row['status']) ? $row['status'] : 'Available';

                echo "<li>";
                echo "<div class='car-details'>";
                echo "<strong>Car Model:</strong> $carModel <br>";
                echo "<strong>Car Status:</strong> $carStatus <br>";
                
                echo "</div>";
                echo "</li>";
            }
        } else {
            echo "<li class='no-cars'>No cars found.</li>";
        }
        ?>
    </ul>
</body>
</html>
