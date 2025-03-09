<?php
include "../Database/db_connect.php";

try {
    $id = $_GET['id'];

    $sql = "DELETE FROM card_colors WHERE card_color_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../Card-color/view_card_color.php?success=1");
    exit();
} catch (\Exception $e) {
    $conn->close();
    die($e);
}
