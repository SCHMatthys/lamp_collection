<nav>
    <ul>
        <li><a href="index.php">ACCUEIL</a></li>
        <li><a href="collection.php">LES LAMPES</a></li>
        <?php if (!isset($_SESSION["username"])){ ?>
            <li><a href="login_page.php">CONNEXION</a></li>
            <li><a href="register_page.php">INSCRIPTION</a></li>
        <?php } else { 
            if (isset($_SESSION["role"])){
                if($_SESSION["role"] == "admin"){ ?>
                    <li><a href="admin_panel.php">PANEL ADMIN</a></li>
        <?php   }
            } ?>
            <li><a href="profil.php?user_id=<?=$_SESSION['userId'];?>">MES AJOUTS</a></li>
            <li><a href="logout.php">DECONNEXION</a></li>
        <?php } ?>  
    </ul>
</nav>