<!DOCTYPE html>
<html>
<head>
    <title>Convert Gambar</title>
    <style>
    body {
        background-image: url('bg2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    h1 {
        background-color: #3498db;
        color: white;
        padding: 20px;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px #888888;
        width: 400px;
        margin: 0 auto;
    }

    input[type="file"] {
        margin-bottom: 10px;
    }

    select {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
    }

    button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-top: 30px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #2980b9;
        
    }

    a {
        text-decoration: none;
        color: #3498db;
    }
</style>

</head>
<body>
    <h1>Convert Gambar</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <select name="conversion_type">
            <option value="jpeg">JPEG</option>
            <option value="png">PNG</option>
            <option value="pdf">PDF</option>
        </select>
        <button type="submit" name="convert">Convert</button>
    </form>
    <button onclick="window.location.href='index.php'">Kembali ke Halaman Utama</button>
    <?php
    if (isset($_POST['convert'])) {
        $image = $_FILES['image'];
        $conversion_type = $_POST['conversion_type'];

        if ($image && $image['error'] == 0) {
            $file_name = $image['name'];
            $file_tmp = $image['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $new_file_name = uniqid() . '.' . $conversion_type;
            $destination = __DIR__ . '/' . $new_file_name;

            if (move_uploaded_file($file_tmp, $destination)) {
                // Check and perform image conversion
                if (($file_ext == 'jpeg' || $file_ext == 'jpg') && $conversion_type == 'png') {
                    $image = imagecreatefromjpeg($destination);
                    imagepng($image, $destination);
                } elseif ($file_ext == 'png' && $conversion_type == 'jpeg') {
                    $image = imagecreatefrompng($destination);
                    imagejpeg($image, $destination, 100);
                } elseif ($conversion_type == 'pdf') {
                    // Convert to PDF using FPDF
                    require('fpdf.php'); // Include the FPDF library
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->Image($destination, 10, 10, 90, 0, $file_ext);
                    $pdf->Output($destination, 'F');
                }

                echo "Gambar berhasil di-convert. <a href='$new_file_name' download>Download</a>";
            } else {
                echo "Gagal mengunggah gambar.";
            }
        }
    }
    ?>
</body>
</html>
