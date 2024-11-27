<?php
// Define upload directory and allowed file types
$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 3 * 1024 * 1024; // 3MB in bytes

// Ensure upload directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];

        // Validate file type and size
        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxFileSize) {
            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Move the uploaded file to the server
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                echo "<p>File uploaded successfully: $fileName</p>";
            } else {
                echo "<p>Failed to upload file.</p>";
            }
        } else {
            echo "<p>Invalid file type or file size exceeds 3MB.</p>";
        }
    }
}

// Retrieve all uploaded images
$images = array_filter(scandir($uploadDir), function ($file) use ($uploadDir) {
    return in_array(mime_content_type($uploadDir . $file), ['image/jpeg', 'image/png', 'image/gif']);
});
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .gallery img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Image Gallery</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept=".jpeg, .jpg, .png, .gif" required>
        <button type="submit">Upload</button>
    </form>

    <div class="gallery">
        <?php foreach ($images as $image): ?>
            <img src="<?php echo $uploadDir . htmlspecialchars($image); ?>" alt="Uploaded Image">
        <?php endforeach; ?>
    </div>
</body>

</html>