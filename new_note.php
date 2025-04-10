<!DOCTYPE html> 

<html>

    <head>  
        <meta charset="utf-8" />
        <title>Nouvelle note</title> 
        <link href="style/style1.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <header>
            <h1>&#128393 Site</h1>
            <a href="new_note.php">&#x2795</a>
        </header>

        <nav>
            <a href="index.html">Accueil</a>
            <a href="list_note.php">Liste note</a>
            <a href="connexion.php">Connexion</a>
        </nav>

        <form action="list_note.php" method="post" accept-charset="UTF-8">
            <label for="titre">Titre de la note</label>
            <input type="text" name="titre" id="titre" value="Titre par défault">
            <br>
            <label for="note">Notons (en Markdown) :</label><br>
            <textarea name="note" id="note" rows="20" cols="50" placeholder="Écrivez..."></textarea>
            <br>
            <label for="date">Date :</label>
            <input type="date" name="date" id="date">
            <br>
            <input type="submit" value="Envoyer">
        </form>


        <script> // Javascript
            // Met la date du jour automatiquement
            const today = new Date().toISOString().split('T')[0];
            // objet JavaScript ex : Mon Apr 07 2025 00:00:00 GMT+0000 (Coordinated Universal Time)
            // convertie en chaine string -> 2025-04-07T00:00:00.000Z
            // on s'arrete à T
            document.getElementById('date').value = today; // mets la valeur par défaut de id="date" à la date d'aujourd'hui
        </script>


    </body>

</html>
