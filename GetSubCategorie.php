<?php
require 'db_connection.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $sql = "SELECT * FROM subcategories WHERE category_id = '$category_id'";
    $result = mysqli_query($conn, $sql);

    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['subcategory_id']}'>{$row['subcategory_name']}</option>";
    }

    echo $options;
}
?>
