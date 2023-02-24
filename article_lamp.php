<?php 
include_once("environement.php");

$request = $bdd->prepare("  SELECT *
                            FROM lampes
                            WHERE id =?");
$request->execute(array($_GET["id"]));

$articleInfo = $request->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?= $articleInfo["lamp_name"]; ?></title>
</head>
<body>

<?php 
include_once("nav.php");
// var_dump($articleInfo);
?>
<section class="main_article">
    <h1><?= $articleInfo["lamp_name"]; ?></h1>
    <div>
        <img src="assets/images/articles/<?=$articleInfo["lamp_image"];?>" alt="image de <?= $articleInfo["lamp_name"]; ?>">
        <p> <?= $articleInfo["lamp_description"];?></p>
    </div>
</section>   
<section class="comment_section">
        <a class="btn" href="comment.php?id=<?=$articleInfo["id"];?>">Voir les commentaires</a>
</section> 

</body>
</html>