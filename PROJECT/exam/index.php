<?php
session_start();

include 'connect.php';

// Pagination variables
$records_per_page = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch data from database with pagination
$sql = "SELECT nhanvien.*, phongban.Ten_Phong 
        FROM nhanvien 
        INNER JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong
        ORDER BY nhanvien.Ma_NV ASC
        LIMIT $offset, $records_per_page";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<header>
    <nav>
        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            echo '<button onclick="window.location.href = \'login.php\';">Sign In</button>';
            echo '<button onclick="window.location.href = \'signup.php\';">Sign Up</button>';
        } else {
            echo '<a href="logout.php">Sign Out</a>';
        }
        ?>
    </nav>
</header>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <table>
        <h1 class="flex">Nhan Vien</h1>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
            <a href="add.php" class="btn btn-success pull-right "><i class="fa fa-plus"></i> Add New Employee</a>
        <?php endif; ?>
        <thead>
            <tr>
                <th data-label="Ma_NV">Ma NV</th>
                <th data-label="Ten_NV">Ten NV</th>
                <th data-label="Phai">Phai</th>
                <th data-label="Noi_Sinh">Noi Sinh</th>
                <th data-label="Ten_Phong">Ten Phong</th>
                <th data-label="Luong">Luong</th>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
                    <th data-label="Actions">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td data-label='Ma_NV'>" . $row["Ma_NV"] . "</td>";
                    echo "<td data-label='Ten_NV'>" . $row["Ten_NV"] . "</td>";
                    echo "<td data-label='Phai'>";
                    if ($row["Phai"] == "NAM") {
                        echo "<img src='img/men.jpg' alt='Male'>";
                    } elseif ($row["Phai"] == "NU") {
                        echo "<img src='img/women.jpg' alt='Female'>";
                    } else {
                        echo "Unknown";
                    }
                    echo "</td>";
                    echo "<td data-label='Noi_Sinh'>" . $row["Noi_Sinh"] . "</td>";
                    echo "<td data-label='Ten_Phong'>" . $row["Ten_Phong"] . "</td>";
                    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user')) {
                        echo "<td data-label='Luong'>" . $row["Luong"] . "</td>";
                    }

                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                        echo "<td data-label='Actions'>";
                        echo "<a href='edit.php?id=" . $row['Ma_NV'] . "'>Edit</a> | ";
                        echo "<a href='delete.php?id=" . $row['Ma_NV'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>";
                        echo "</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Pagination links
    $sql = "SELECT COUNT(*) AS total FROM nhanvien";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<div class='flex'>";
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
    }
    echo "</ul>";
    echo "</div>";
    ?>

</body>
<footer>
    <p>Author:Huynh Nhat Truong</p>
    <p><a href="mailto:huynhnhattruonglt@gmail.com">huynhnhattruonglt@gmail.com</a></p>
</footer>

</html>

<?php
$conn->close();
?>