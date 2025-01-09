<?php
if (!isset($_SESSION['id_user'])) {
    include("../Front-end/se_connecter/se_connecter.php");
    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'connection_database.php';

$sql = "SELECT SUM(quantity * CAST(REPLACE(rate, ',', '.') AS DECIMAL(10, 2))) AS total FROM `product` WHERE rate IS NOT NULL AND REPLACE(rate, ',', '.') REGEXP '^[0-9]+(\.[0-9]+)?$';";
          $stmt = $conn->prepare($sql);
          $stmt->execute();


          // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the result is not null and echo the total
        if ($result['total'] !== null) {
            echo '<span style="float: left;
            border-left: 6px solid black;
            padding-left: 5px;
            font-weight: 700;"> Total stock : <span style = "    background: black;
            color: white;
            padding: 5px;
            border-radius: 4px;">' . number_format($result['total'], 2) . ' DH</span></span>';
        } else {
            echo "Total: 0.00";
        }

?>