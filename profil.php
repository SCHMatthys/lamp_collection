<?php 
include_once("environement.php");

$request = $bdd->query("    SELECT *
                            FROM lampes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profil</title>
</head>
<body>
<?php
include_once("nav.php");
?>
<h1>Mes ajouts</h1>
<section class="section_collection">
    <?php 
    while ($lamps = $request->fetch()){ 
// var_dump($_SESSION,$lamps);
        if($lamps["user_id"] == $_SESSION["userId"]){?>
        <article class="article_collection">
            <a href="<?= 'article_lamp.php?id=' . $lamps["id"];?>">
                <img src="assets/images/articles/<?= $lamps["lamp_image"]; ?>" alt="image de <?= $lamps["lamp_name"]; ?>">
                <h2> <?= $lamps["lamp_name"] ?></h2>
            </a>
            <div>
                <a class="btn btn_edit" href="<?='article_modification.php?id=' . $lamps["id"]; ?> ">Modifier</a>
                <a class="btn btn_delete" href="">Supprimer</a>
            </div>
        </article>
    <?php }}?>
</section>   
</body>
</html>