<!DOCTYPE html>
<html>

<head>
    <title>Ubah Resolusi Gambar</title>
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

        label {
            display: block;
            text-align: left;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
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
    <h1>Ubah Resolusi Gambar</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <label for="width">Panjang (px):</label>
        <input type="number" name="width" id="width" required>
        <label for="height">Lebar (px):</label>
        <input type="number" name="height" id="height" required>
        <button type="submit" name="convert">Submit</button>
    </form>

    <?php
    if (isset($_POST['convert'])) {
        $image = $_FILES['image'];
        $width = $_POST['width'];
        $height = $_POST['height'];

        if ($image && $image['error'] == 0) {
            $file_name = $image['name'];
            $file_tmp = $image['tmp_name'];

            $new_file_name = uniqid() . '.jpg'; // Gambar hasil akan disimpan dalam format JPEG
            $destination = __DIR__ . '/' . $new_file_name;

            if (move_uploaded_file($file_tmp, $destination)) {
                // Ubah resolusi gambar
                list($origWidth, $origHeight) = getimagesize($destination);
                $newImage = imagecreatetruecolor($width, $height);
                $source = imagecreatefromjpeg($destination);
                imagecopyresized($newImage, $source, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
                imagejpeg($newImage, $destination);
                imagedestroy($newImage);

                echo "Gambar berhasil diubah resolusinya. <a href='$new_file_name' download>Download</a>";
            } else {
                echo "Gagal mengunggah gambar.";
            }
        }
    }
    ?>
    <button onclick="window.location.href='index.php'">Kembali ke Halaman Utama</button>
</body>

</html>