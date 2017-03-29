<?php
try {
    if (isset($_FILES["file"]['tmp_name'])) {
//        $path = $_FILES['file']['name'];
//        $ext = pathinfo($path, PATHINFO_EXTENSION);
//        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
//        $targetPath = "../Presentacion/image/" . $_FILES["file"]["name"]; // Target path where file is to be stored
//        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
//        echo $_POST["otro"];
        $path = $_FILES['file']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
        $targetPath = "../Presentacion/image/escudos/" . $_POST["nombreImagen"].".".$ext; // Target path where file is to be stored
        move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
        echo "bien";
    } else {
        echo "mal";
    }
}catch (Exception $e) {
    echo $e;
}
?>