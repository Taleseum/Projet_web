<!DOCTYPE html >
<html>
<head>
        <meta charset="utf-8" />
        <title>Bienvenue sur mon nouveau blog ! </title>
</head>

    <link href="style/style2.css" type="text/css" rel="stylesheet" />
    <style>
        a {color:black;}
    </style>
    <body>

<header>
    &#128393 <i>Bienvenue sur notre nouveau blog !</i>
    <a href= "new_note.php">	&#x2795</a> 
</header>

<nav>
    
</nav>

<section>
    <article>
      <h2>Dernier article</h2>
        <?php
        $filePath = "note/notes.txt";
        if (file_exists($filePath)) {
            $notesRaw = explode("---\n", file_get_contents($filePath));
            $latestDate = null;

            foreach ($notesRaw as $noteBlock) {
                if (preg_match('/📅 \[(?P<date>\d{4}-\d{2}-\d{2})\]/', $noteBlock, $matches)) {
                    $currentDate = DateTime::createFromFormat('Y-m-d', $matches['date']);
                    if ($latestDate === null || $currentDate > $latestDate) {
                        $latestDate = $currentDate;
                    }
                } elseif (preg_match('/\[(?P<date>\d{4}-\d{2}-\d{2})\]/', $noteBlock, $dateMatches) && $latestDate === null) {
                    $currentDate = DateTime::createFromFormat('Y-m-d', $dateMatches[1]);
                    if ($latestDate === null || $currentDate > $latestDate) {
                        $latestDate = $currentDate;
                    }
                }
            }

            if ($latestDate) {
                // Utilisation de IntlDateFormatter pour un format français (recommandé)
                if (extension_loaded('intl')) {
                    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                    echo "<p><em>Publié le " . $formatter->format($latestDate) . "</em></p>";
                }
            } else {
                echo "<p>Aucun article n'a été trouvé.</p>";
            }
        } else {
            echo "<p>Le fichier de notes est introuvable.</p>";
        }
        ?>
        <a href="list_note.php"><i>Voir l'article sur cette page... </i></a>
    </article>

    <article>
      <iframe src="note/calendrier.php"></iframe>
    </article>

    <aside>      
        <h3>Vous pouvez voir aussi :</h3>   
      <ul>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="list_note.php">Liste note</a></li>
      </ul>
      <h4>Si vous voulez ajouter une nouvelle note, merci de cliquer sur le "&#x2795"</h4>  
    </aside>
</section>


<footer>
    <p>&copy; 2025 Mon Nouveau Blog - Tous droits réservés</p>
</footer>


    </body>
</html>
