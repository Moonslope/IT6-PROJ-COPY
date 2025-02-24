<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    try {
        $card_color = trim($_POST['card_color']); // Trim spaces

        // Check if the color already exists
        $checkSql = "SELECT COUNT(*) FROM card WHERE card_color = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $card_color);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            // Redirect with duplicate error
            echo "<script>
                window.location.href = '../Card-color/add_card_color.php?error=duplicate';
            </script>";
            exit;
        }

        // Insert new card color
        $sql = "INSERT INTO card(card_color) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $card_color);

        if ($stmt->execute()) {
            echo "<script>
                alert('Card color added successfully!');
                window.location.href = '../Card-color/view_card_color.php';
            </script>";
        } else {
            echo "<script>
                alert('Error adding card color: " . $stmt->error . "');
                window.location.href = '../Card-color/add_card_color.php';
            </script>";
        }

        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $conn->close();
        die($e);
    }
}
