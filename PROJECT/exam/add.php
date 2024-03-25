<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Ma_NV = $_POST['Ma_NV'];
    $Ten_NV = $_POST['Ten_NV'];
    $Phai = $_POST['Phai'];
    $Noi_Sinh = $_POST['Noi_Sinh'];
    $Ma_Phong = $_POST['Ma_Phong'];
    $Luong = $_POST['Luong'];

    $sql = "INSERT INTO nhanvien (Ma_NV,Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$Ma_NV','$Ten_NV', '$Phai', '$Noi_Sinh', '$Ma_Phong', '$Luong')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form method="post">
        <div class="form-group">
                <label for="Ma_NV">ID:</label>
                <input type="text" class="form-control" id="Ma_NV" name="Ma_NV" required>
            </div>
            <div class="form-group">
                <label for="Ten_NV">Name:</label>
                <input type="text" class="form-control" id="Ten_NV" name="Ten_NV" required>
            </div>
            <div class="form-group">
                <label for="Phai">Gender:</label>
                <select class="form-control" id="Phai" name="Phai" required>
                    <option value="NAM">NAM</option>
                    <option value="NU">NU</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Noi_Sinh">Place of Birth:</label>
                <input type="text" class="form-control" id="Noi_Sinh" name="Noi_Sinh" required>
            </div>
            <div class="form-group">
                <label for="Ma_Phong">Department:</label>
                <input type="text" class="form-control" id="Ma_Phong" name="Ma_Phong" required>
            </div>
            <div class="form-group">
                <label for="Luong">Salary:</label>
                <input type="text" class="form-control" id="Luong" name="Luong" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>

<?php
$conn->close();
?>
