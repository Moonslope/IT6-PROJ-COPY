<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    try {
        $card_color = trim($_POST['card_color']); // Trim spaces

        // Check if the color already exists
        $checkSql = "SELECT COUNT(*) FROM card_colors WHERE card_color_name = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $card_color);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            // Redirect to the modal page with an error flag
            header("Location: ../Card-color/add_card_color.php?error=duplicate");
            exit; // Stop execution
        }


        // Insert new card color
        $sql = "INSERT INTO card_colors(card_color_name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $card_color);

        if ($stmt->execute()) {
            header('Location: ../Card-color/add_card_color.php?success=1');
        }

        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $conn->close();
        die($e);
    }
}
