

<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM nhanvien WHERE Ma_NV='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>