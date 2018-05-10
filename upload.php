
<?php
$target_dir = "profil/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}
$target_file="profil/".$userid.'.'.pathinfo($target_file, PATHINFO_EXTENSION);
// Check if file already exists
if (file_exists($target_file)) {
    if (!unlink($target_file)) echo "Erreur lors de la suppresssion de l'ancienne photo.";
    else echo "L'ancienne photo a été supprimée";
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Le fichier est trop large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Merci de ré, seul les fichiers jpg, gif et png sont autorisés.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Le fichier n'a pas été téléchargé, merci de réessayer.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        require_once 'connect.php';
        $req = "UPDATE users SET photo=\"".$target_file."\" WHERE username = \"".$_SESSION["username"]."\";";
        $res = mysqli_query($co,$req);
        echo $req;
        if (!$res) echo "error";
        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été téléchargé.";
    } else {
        echo "Le fichier n'a pas été téléchargé, merci de réessayer.";
    }
}
?>
