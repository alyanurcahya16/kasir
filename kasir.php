<?php
session_start();

if (!isset($_SESSION["kasir"])) {
    $_SESSION["kasir"] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item"]) && isset($_POST["harga"]) && isset($_POST["jumlah"])) {
    $data = array(
        "item" => $_POST["item"],
        "harga" => $_POST["harga"],
        "jumlah" => $_POST["jumlah"],
    );
    array_push($_SESSION["kasir"], $data);
    header('Location: kasir.php'); // Redirect to prevent form resubmission
    exit;
}

if (isset($_GET['page'])) {
    $index = $_GET['page'];
    unset($_SESSION['kasir'][$index]);
    header('Location: kasir.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko 88</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
      label {
        display: inline-block;
        width: 100px;
        text-align: center;
        margin-right: 10px;
      }
    </style>
</head>
<body>
    <div class="container">
        <h1>Toko 88</h1>
        <div class="form-container">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="item">Item:</label>
                    <input type="text" name="item" id="item" class="form-control" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="harga">Harga:</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="kirim" value="kirim"><i class='bx bx-plus'></i> Tambah</button>
                    <button class="btn btn-secondary" name="cetak" value="cetak"><a href="struk.php" class="text-white text-decoration-none"><i class='bx bx-printer'></i> Cetak</a></button>
                    <button class="btn btn-danger" name="hapus" value="hapus"><a href="hapus.php" class="text-white text-decoration-none"><i class='bx bx-trash'></i> Hapus Data</a></button>
                </div>
            </form>
        </div>
      
        <div class="table-responsive">
            <?php
            echo "<table class='table table-bordered'>";
            echo "<thead class='table-dark'>";
            echo "<tr>";
            echo "<th>Item</th>";
            echo "<th>Harga</th>";
            echo "<th>Jumlah</th>";
            echo "<th>Hapus</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
        
            foreach ($_SESSION["kasir"] as $index => $value) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($value["item"]) . "</td>";
                echo "<td>" . htmlspecialchars($value["harga"]) . "</td>";
                echo "<td>" . htmlspecialchars($value["jumlah"]) . "</td>";
                echo "<td><a href='?page=".$index."' class='btn btn-danger'><i class='bx bx-trash'></i> Hapus</a></td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
