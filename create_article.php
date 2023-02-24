<?php
include_once("environement.php");
if (!isset($_SESSION["username"])){
    header("location:index.php");
}

if (isset($_POST["article_name"]) && isset($_POST["article_description"])) {
    $name = htmlspecialchars($_POST["article_name"]);
    $description = htmlspecialchars($_POST["article_description"]);

    if (isset($_FILES["article_image"])){
        $image = $_FILES["article_image"]["name"];
        $imgTemp = $_FILES["article_image"]["tmp_name"];
        $image_info = pathinfo($image);
        $imageName = $image_info["filename"];
        $imageExt = $image_info["extension"];
        $uniqueImageName = $imageName . time() . rand(0, 9999) . "." . $imageExt;
        move_uploaded_file($imgTemp, "assets/images/articles/" . $uniqueImageName);

        $request = $bdd->prepare("  INSERT INTO lampes(lamp_name, lamp_description, lamp_image,user_id)
                                    VALUES(?,?,?,?)");
        $request->execute(array($name,$description,$uniqueImageName,$_SESSION["userId"]));
        header("location:collection.php?addedarticle=1");
    };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Nouvelle lampe</title>
</head>
<body>
<?php 
include_once("nav.php");
?>
<h1>Ajouter une lampe à la collection</h1>
<form class="form_create_article" action="create_article.php" method="POST" enctype="multipart/form-data">
    <label for="article_name">Nom du model</label>
    <input type="text" id="article_name" name="article_name" placeholder="article name">

    <label for="article_description">Description / Infos du model</label>
    <textarea name="article_description" id="article_description" cols="30" rows="10" placeholder="Model description"></textarea>

    <label for="article_image">Image de la lampe</label>
    <input class="input_file" type="file" name="article_image" id="article_image">

    <button>Ajouter à la collection</button>
</form>
</body>
</html>