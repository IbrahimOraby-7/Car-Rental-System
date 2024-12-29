<?php
@include 'config.php';

$sql = "SELECT r.*, u.name AS customer_name FROM reservations r
        JOIN users u ON r.customer_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations List</title>
    <style>
 .reservation-item-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1),
                    0 4px 16px rgba(0, 0, 0, 0.1),
                    0 6px 20px rgba(0, 0, 0, 0.1);
                    transition: box-shadow 0.3s ease-in-out;
            cursor: pointer;
            margin: 10px; 
        }

        .reservation-item-container:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .reservation-details strong {
        font-weight: bold;
        color: #0056b3; 
    }
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

.reservation-list {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.reservation-item {
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

.reservation-item:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.reservation-details {
    font-size: 14px;
    line-height: 1.5;
}

.reservation-details strong {
    font-weight: bold;
    color: #0056b3; 
}


.no-reservations {
    text-align: center;
    font-style: italic;
    color: #888;
    margin-top: 20px;
}
.back-to-dashboard-container {
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }

        .back-to-dashboard {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .back-to-dashboard a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .back-to-dashboard a:hover {
            color: #0056b3;
        }
</style>
</head>


<body>
<h2>Reservations List</h2>


<form action="" method="post" class="search-form">
    <label for="start_date"><b>Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date"><b>End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <input type="submit" name="submit" value="Search">
</form>


<?php
        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) {
                $reservationId = $row['reservation_id'];
                $carId = $row['car_id'];
                $customerId = $row['customer_id'];
                $startDate = $row['start_date'];
                $endDate = $row['end_date'];
                $location = $row['location'];
                $customerName = isset($row['customer_name']) ? $row['customer_name'] : 'N/A';
    ?>
                
                <div class="reservation-item-container">
                    <div class="reservation-details">
                        <strong>Reservation ID:</strong> <?php echo $reservationId; ?> <br>
                        <strong>Car ID:</strong> <?php echo $carId; ?> <br>
                        <strong>Customer ID:</strong> <?php echo $customerId; ?> <br>
                        <strong>Start Date:</strong> <?php echo $startDate; ?> <br>
                        <strong>End Date:</strong> <?php echo $endDate; ?> <br>
                        <strong>Location:</strong> <?php echo $location; ?> <br>
                        <strong>Customer Name:</strong> <?php echo $customerName; ?> <br>
                    </div>
                </div>
    <?php
            }
        } else {
            echo "<p class='no-reservations'>No reservations found.</p>";
        }
    ?>
    
</body>
</html>