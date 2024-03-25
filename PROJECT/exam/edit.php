

<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql = "UPDATE nhanvien SET Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh', Ma_Phong='$ma_phong', Luong='$luong' WHERE Ma_NV='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM nhanvien WHERE Ma_NV='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Record</title>
<link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="container mt-5">
<div class="form-group">
<h2>Edit Record</h2>
    <div>
  <input type="hidden" class="form-control" name="id" value="<?php echo $row['Ma_NV']; ?>">
  <label for="ten_nv">Ten NV:</label><br>
  </div>
  <div>
  <input type="text" id="ten_nv" class="form-control" name="ten_nv" value="<?php echo $row['Ten_NV']; ?>">
  <label for="phai">Phai:</label>
  </div>
  <div>
  <input type="text" id="phai" class="form-control" name="phai" value="<?php echo $row['Phai']; ?>">
  <label for="noi_sinh">Noi Sinh:</label>
  </div>
  <div>
  <input type="text" id="noi_sinh" class="form-control" name="noi_sinh" value="<?php echo $row['Noi_Sinh']; ?>">
  <label for="ma_phong">Ma Phong:</label>
  </div>
  <div>
  <input type="text" id="ma_phong" class="form-control" name="ma_phong" value="<?php echo $row['Ma_Phong']; ?>">
  <label for="luong">Luong:</label>
  </div>
  <div>
  <input type="text" id="luong" class="form-control" name="luong" value="<?php echo $row['Luong']; ?>">
  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
</div>
</form>
</div>


</body>
</html>

<?php
$conn->close();
?>