<?php 
include_once("environement.php");
if (isset($_POST["username"]) && (isset($_POST["password"])) && (isset($_POST["confirm_password"])) && (isset($_POST["email"]))) {
    $username = htmlspecialchars(trim(strtolower($_POST["username"])));
    $password = htmlspecialchars(trim($_POST["password"]));
    $confirmPassword = htmlspecialchars(trim($_POST["confirm_password"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    if($password == $confirmPassword){
        $userCount = $bdd->prepare("    SELECT COUNT(*) AS usercount
                                        FROM users
                                        WHERE username = ?");

        $userCount->execute([$username]);

        while ($count = $userCount->fetch()){
            $countVerify = $count["usercount"];
            $role = "user";

            if($countVerify < 1){   
                $criptedPassword = sha1("Biffle" . sha1("F1u0" . $password . "Biffle lugubre"));

                $request = $bdd->prepare("  INSERT INTO users(username,password,email,role)
                                            VALUES(?,?,?,?)");
                $request->execute(array($username, $criptedPassword, $email, $role));
                header("location:login_page.php?regisersucces=1");
            } else{
                header("location:register_page.php?useralreadyexist=1");
            }
        }
    } else {
        header("location:register_page.php?registererror=1");
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
    <title>Inscription</title>
</head>

<body>
<?php 
include_once("nav.php")
?>
<h1>inscription</h1>
<main>
    <form class="form" action="register_page.php" method="POST">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" placeholder="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="password">

        <label for="confirm_password">Confirmer le mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm password">

        <label for="email">Adresse mail</label>
        <input type="email" id="email" name="email" placeholder="email">

        <button>S'inscrire</button>
    </form>
</main>
</body>
</html>