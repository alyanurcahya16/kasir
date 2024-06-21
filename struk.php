<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .struk-header, .struk-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .struk-header h2, .struk-header p {
            margin: 0;
        }
        .struk-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #000;
        }
        .struk-total {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-top: 2px dashed #000;
            font-weight: bold;
        }
        .struk-container {
            border: 1px dashed #000;
            padding: 20px;
            margin-top: 20px;
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="struk-container">
            <div class="struk-header">
                <h2>TOKO 88</h2>
                <p>jl. harapan orangtua</p>
                <p>Telepon: 1207-2231-0521</p>
                <p><?= date('d-m-Y H:i:s') ?></p>
            </div>
            <?php
            session_start();
            
            if (!isset($_SESSION["kasir"])) {
                $_SESSION["kasir"] = array();
            }

            if (!empty($_SESSION["kasir"])) {
                $totalHarga = 0;

                foreach ($_SESSION["kasir"] as $value) {
                    $subtotal = $value["harga"] * $value["jumlah"];
                    $totalHarga += $subtotal;
                    echo "<div class='struk-item'>";
                    echo "<div>" . htmlspecialchars($value["item"]) . "</div>";
                    echo "<div>" . htmlspecialchars($value["jumlah"]) . " x " . number_format($value["harga"], 2, ',', '.') . "</div>";
                    echo "<div>" . number_format($subtotal, 2, ',', '.') . "</div>";
                    echo "</div>";
                }

                echo "<div class='struk-total'>";
                echo "<div>Total</div>";
                echo "<div>" . number_format($totalHarga, 2, ',', '.') . "</div>";
                echo "</div>";
            } else {
                echo "<p>Tidak ada item dalam kasir.</p>";
            }
            ?>
            <div class="struk-footer">
                <p>Terima kasih telah berbelanja di toko kami!</p>
                <p>Semoga hari Anda menyenangkan!</p>
            </div>
        </div>
        <div class="mt-3 text-center">
            <button class="btn btn-primary" onclick="window.print()"><i class='bx bx-printer'></i> Print</button>
            <a href="hapus.php" class="btn btn-danger"><i class='bx bx-trash'></i> Hapus Data</a>
            <a href="kasir.php" class="btn btn-secondary"><i class='bx bx-arrow-back'></i> Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
