<?php
session_start();

$identifiant_correct = "presentation";
$mot_de_passe_correct = "blog";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["identifiant"]) && isset($_POST["mdp"])) {
        $identifiant_saisi = trim($_POST["identifiant"]);
        $mot_de_passe_saisi = trim($_POST["mdp"]);

        if ($identifiant_saisi === $identifiant_correct && $mot_de_passe_saisi === $mot_de_passe_correct) {
            // Authentification réussie
            $_SESSION["utilisateur_connecte"] = true;
            header("Location: list_note.php"); // Rediriger vers la liste des notes
            exit();
        } else {
            $erreur_connexion = "Identifiant ou mot de passe incorrect.";
            $_SESSION["erreur_connexion"] = $erreur_connexion;
            header("Location: connexion.php"); // Rediriger vers la page de connexion
            exit();
        }
    }
$_SESSION["utilisateur"] = $identifiant_saisi;
}
?>