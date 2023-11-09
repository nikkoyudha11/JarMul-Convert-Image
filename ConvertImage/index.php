<!DOCTYPE html>
<html>
<head>
    <title>Convert Image-NIH</title>
    <style>
    body {
        background-image: url('bg2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        display: flex; /* Menggunakan flexbox untuk perataan tengah */
        flex-direction: column; /* Tumpuk elemen vertikal */
        justify-content: center; /* Perataan vertikal tengah */
        align-items: center; /* Perataan horizontal tengah */
        height: 100vh; /* Mempertahankan latar belakang pada tinggi layar */
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column; /* Tumpuk elemen dalam form vertikal */
        align-items: center; /* Perataan horizontal tengah dalam form */
    }

    button {
        margin: 10px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: aqua;
    }
    .button-container {
        display: flex; /* Menggunakan flexbox untuk membuat tombol sejajar kesamping */
        gap: 10px; /* Jarak antara tombol */
    }
</style>

</head>
<body>
    <h1>Welcome To Convert Image-NIH</h1>
    <h2>Silahkan Pilih :</h2>
    <form method="post">
    <div class="button-container">
        <button type="submit" name="action" value="convert">Convert</button>
        <button type="submit" name="action" value="ubah_resolusi">Ubah Resolusi</button>
        <button type="submit" name="action" value="reduce_size">Reduce Size</button>
    </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["action"])) {
            $action = $_POST["action"];
            switch ($action) {
                case "convert":
                    header("Location: convert.php");
                    break;
                case "ubah_resolusi":
                    header("Location: ubah_resolusi.php");
                    break;
                case "reduce_size":
                    header("Location: reduce_size.php");
                    break;
                default:
                    echo "Pilihan tidak valid.";
            }
        }
    }
    ?>
</body>
</html>
