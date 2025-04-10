<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>
        <link href="style/style1.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1>Site</h1>
            <a href="index.php">&#x2795</a>
        </header>

        <nav>
            <a href="index.php">Accueil</a>
            <a href="list_note.php">Liste note</a>
            <a href="new_note.php">Nouvelle note</a>
        </nav>

        <form method="post" action="traitement_connexion.php">
            <label for="identifiant">Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" class="identifiant" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" class="mdp" required>

            <input type="submit" value="Se connecter">
        </form>

        <?php
            if (isset($_SESSION["erreur_connexion"])) {
                echo '<p style="color: red;">' . $_SESSION["erreur_connexion"] . '</p>';
                unset($_SESSION["erreur_connexion"]); // Effacer l'erreur après l'affichage
            }
        ?>

    </body>
</html>