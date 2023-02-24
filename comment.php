<?php 
include_once("environement.php");
$date = date("F j, Y, g:i a");
$articleId = $_GET["id"];
// var_dump($date,$articleId,$_SESSION,$_POST);


if(isset($_SESSION["role"])){
    if(isset($_POST["add_comment"])){
        $commentaire = $_POST["add_comment"];
        $request = $bdd->prepare("  INSERT INTO commentaires(commentaire,user_id,date,article_id)
                                    VALUES(?,?,?,?)");
        $request->execute(array($commentaire,$_SESSION["userId"],$date,$articleId));
        // header("location:comment.php");
        // var_dump($_SESSION);
    }
}

$request_showComments = $bdd->prepare(" SELECT *
                                        FROM commentaires
                                        WHERE article_id = ?");
$request_showComments->execute(array($articleId));
$commentaires = $request_showComments->fetchAll();
// var_dump($commentaires);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Commentaires</title>
</head>
<body>
<?php
include_once("nav.php");
?>
<h1>commentaires</h1>
<form action="comment.php?id=<?=$articleId;?>" method="POST">
    <label for="add_comment">Ajouter un commentaire</label>
    <textarea name="add_comment" id="add_comment" cols="50" rows="3" placeholder="add comment"></textarea>
    <button> Ajouter</button>
</form>
<div class="comment_container">
    <h2>Derniers commentaires</h2>
    <?php  foreach ($commentaires as $commentaire){ ?>
        <div>
            <p><?= $commentaire["commentaire"];?></p>
            <span> <?= $commentaire["date"]; ?></span>
            <span> by : <?= $commentaire["user_id"];?></span>
            <br>
        </div>
    <?php };?>
</div>


</body>
</html>