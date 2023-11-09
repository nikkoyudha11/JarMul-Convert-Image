<!DOCTYPE html>
<html>

<head>
    <title>Reduce Size Gambar</title>
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

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
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
    <h1>Reduce Size Gambar</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="reduce">Submit</button>
    </form>

    <?php
    if (isset($_POST['reduce'])) {
        $image = $_FILES['image'];

        if ($image && $image['error'] == 0) {
            $file_name = $image['name'];
            $file_tmp = $image['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if (strtolower($file_ext) == 'jpg' || strtolower($file_ext) == 'jpeg') {
                $new_file_name = uniqid() . '.jpg';
                $destination = __DIR__ . '/' . $new_file_name;

                if (move_uploaded_file($file_tmp, $destination)) {
                    list($origWidth, $origHeight) = getimagesize($destination);
                    $newWidth = $origWidth * 0.5;
                    $newHeight = $origHeight * 0.5;
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    $source = imagecreatefromjpeg($destination);

                    if ($source) {
                        imagecopyresized($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                        imagejpeg($newImage, $destination);
                        imagedestroy($newImage);

                        echo "Ukuran gambar berhasil dikurangi. <a href='$new_file_name' download>Download</a>";
                    } else {
                        echo "Gagal membuka gambar.";
                    }
                } else {
                    echo "Gagal mengunggah gambar.";
                }
            } else {
                echo "Gambar harus dalam format JPEG.";
            }
        }
    }
    ?>
    <button onclick="window.location.href='index.php'">Kembali ke Halaman Utama</button>
</body>

</html>