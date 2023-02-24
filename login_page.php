<?php 
include_once("environement.php");
if (isset($_POST["username"]) && (isset($_POST["password"]))){
    if (!empty($_POST["username"]) && (!empty($_POST["password"]))){
        $username = htmlspecialchars(trim(strtolower($_POST["username"])));
        $password = $_POST["password"];
        $criptedPassword = sha1("Biffle" . sha1("F1u0" . $password . "Biffle lugubre"));

        $request = $bdd->prepare("  SELECT *
                                    FROM users
                                    WHERE username = ?");
        $request->execute(array($username));

        while ($userData = $request->fetch()){
            if ($criptedPassword == $userData["password"]){
                $_SESSION["username"] = $userData["username"];
                $_SESSION["role"] = $userData["role"];
                $_SESSION["userId"] = $userData["id"];
                header("location:index.php?connexionsucces=1");
            } else{
                header("location:login_page.php?passworderror=1");
            };
        };
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
    <title>Connexion</title>
</head>
<body>
<?php 
include_once("nav.php")
?>
<h1>connexion</h1>
<main>
    <form class="form" action="login_page.php" method="POST">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" placeholder="username">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="password">

        <button>Se connecter</button>
    </form>
</main>
</body>
</html>