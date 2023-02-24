<?php 
include_once("environement.php");
$articleId = $_GET["id"];

$request = $bdd->prepare("  SELECT *
                            FROM lampes
                            WHERE id = ?");
$request->execute(array($articleId));
$articles = $request->fetchAll();
var_dump($articles);
foreach ($articles as $article){
    if($_SESSION["userId"] == $article["user_id"] || $_SESSION["role"] == "admin"){
        if(isset($_POST["article_name"]) && (isset($_POST["article_description"]))){
            $name = htmlspecialchars($_POST["article_name"]);
            $description = htmlspecialchars($_POST["article_description"]);

            $requestUpdate = $bdd->prepare("    UPDATE lampes
                                                SET lamp_name = :name, lamp_description = :description
                                                WHERE id = :id");
            $requestUpdate->execute(array(
                "name"          => $name,
                "description"   => $description,
                "id"            => $articleId
            ));
            header("location:profil.php");
        }
    }
};




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Modifier</title>
</head>
<body>

<?php 
include_once("nav.php");
?>
<h1>modifier</h1>
<form action="article_modification.php<?= "?id=" . $articleId ?>" method="POST">
    <?php foreach ($articles as $article){ ?>
        <label for="article_name">Nom du model</label>
        <input type="text" id="article_name" name="article_name" placeholder="article name" value="<?= $article["lamp_name"]; ?>">

        <label for="article_description">Description / Infos du model</label>
        <textarea name="article_description" id="article_description" cols="30" rows="10" ><?= $article["lamp_description"]; ?></textarea>
<!-- 
        <label for="article_image">Image de la lampe</label>
        <input class="input_file" type="file" name="article_image" id="article_image"> -->
     <?php } ?>
    

    <button>Modifier</button>
</form>
</body>
</html>