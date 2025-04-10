        <!DOCTYPE html>

        <html>

            <head>  
                <meta charset="utf-8" />
                <title>Liste note</title> 
                <link href="style/style1.css" rel="stylesheet" type="text/css" />
            </head>

            <body>
                <header>
                    <h1>&#128393 Site</h1>
                    <a href="new_note.php">&#x2795</a>
                </header>

                <nav>
                    <a href="index.php">Accueil</a>
                    <a href="new_note.php">Nouvelle note</a>
                    <a href="connexion.php">Connexion</a>
                </nav>
                <?php
                    require 'vendor/autoload.php';
                function date_avant($dt1, $dt2) // Compare les dates
                    {
                        $annee1 = $dt1[1]*1000 + $dt1[2]*100 + $dt1[3]*10 + $dt1[4];
                        $mois1  = $dt1[6]*10 + $dt1[7];
                        $jour1  = $dt1[9]*10 + $dt1[10];

                        $annee2 = $dt2[1]*1000 + $dt2[2]*100 + $dt2[3]*10 + $dt2[4];
                        $mois2  = $dt2[6]*10 + $dt2[7];
                        $jour2  = $dt2[9]*10 + $dt2[10];

                        if ($annee1 < $annee2) return -1;
                        if ($annee1 > $annee2) return 1;
                        if ($mois1 < $mois2) return -1;
                        if ($mois1 > $mois2) return 1;
                        if ($jour1 < $jour2) return -1;
                        if ($jour1 > $jour2) return 1;

                        return 0;
                    }

                $filePath = "note/notes.txt";

                if (!is_dir("note"))
                    {
                        mkdir("note", 0777, true);
                    }

                $Parsedown = new Parsedown();

                // Lecture des notes existantes
                $notesArray = [];

                if (file_exists($filePath))
                    {
                        $notesRaw = explode("---\n", file_get_contents($filePath));
                        foreach ($notesRaw as $noteBlock)
                            {
                                if (preg_match('/\[([0-9]{4}-[0-9]{2}-[0-9]{2})\]/', $noteBlock, $matches))
                                    {
                                        $date = "[" . $matches[1] . "]";
                                        $notesArray[] = ['date' => $date, 'content' => $noteBlock];
                                    }
                            }
                    }

                // Ajout d'une nouvelle note si formulaire envoyé
                if (!empty($_POST['titre']) && !empty($_POST['note']) && !empty($_POST['date']))
                    {
                        $titre = htmlspecialchars($_POST['titre']);
                        $note = $_POST['note']; // pour garder le markdown on ne met pas htmlspecialchars
                        $date = htmlspecialchars($_POST['date']);
                        $noteHtml = $Parsedown->text($note);

                        $utilisateur = $_SESSION["utilisateur"]; // Assure-toi que la session est bien démarrée

                        $entry = "👤 [$utilisateur] 📅 [" . $date . "] - 📌 *" . $titre . "*\n" . $noteHtml . "\n";

                        $notesArray[] = ['date' => "[" . $date . "]", 'content' => $entry];

                        echo "<p><strong>Note enregistrée et triée !</strong></p>";
                    }
                    elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
                    {
                        echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
                    }

                // Tri des notes
                usort($notesArray, function($a, $b) // Usort trie un tableau en functionde la fonction (chercher si c function ou date_avant)
                    {
                        return date_avant($a['date'], $b['date']);
                    });

                // Écriture triée dans le fichier
                $finalText = '';
                foreach ($notesArray as $note)
                    {
                        $finalText .= $note['content'] . "---\n";
                    }
                file_put_contents($filePath, $finalText);

                // Affichage
                    echo "<h2>🗒️ Vos notes :</h2>";

                    foreach ($notesArray as $note)
                    {
                        echo "<div class='note-content'>";
                        echo $Parsedown->text($note['content']);
                        echo "</div>";
                    }
                ?>
