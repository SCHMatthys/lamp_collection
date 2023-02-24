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
    <title>Collection</title>
</head>
<body>
<?php 
include_once("nav.php");
?>
<h1>Les lampes</h1>
<?php if (isset($_SESSION["username"])){ ?>
    <a class="a_btn" href="create_article.php">Ajouter une lampe à la collection</a>
<?php } ?>
<section class="section_collection">
    <?php 
    while ($lamps = $request->fetch()){ ?>
        <article class="article_collection">
            <a href="<?= 'article_lamp.php?id=' . $lamps["id"];?>">
                <img src="assets/images/articles/<?= $lamps["lamp_image"]; ?>" alt="image de <?= $lamps["lamp_name"]; ?>">
                <h2> <?= $lamps["lamp_name"] ?></h2>
                <!-- <p> <?= $lamps["lamp_description"] ?> </p> -->
            </a>
        </article>
    <?php }?>
</section>
</body>
</html>