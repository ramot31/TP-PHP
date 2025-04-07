<?php

class Etudiant {
    private string $nom;
    private array $notes;

    public function __construct($nom="", $notes=null) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotes() {
        echo "<ul><li style='background-color: grey; padding: 5px; margin: 2px; width: 300px; text-align: center;'> {$this->nom} </li>";
        foreach ($this->notes as $note) {
            $couleur = $note < 10 ? 'red' : ($note > 10 ? 'lightgreen' : 'orange');
            echo "<li style='background-color: $couleur; padding: 5px; margin: 2px; width: 300px; text-align: center;'>{$note}</li>";
        }
        echo " <li style= 'background-color: lightblue; padding: 5px; margin: 2px; width: 300px; text-align: center;'> Votre moyenne est : {$this->calculerMoyenne()}</li>";
        echo "</ul>";
    }

    public function calculerMoyenne() {
        return array_sum($this->notes) / count($this->notes);
    }

    public function afficherResultat() {
        $moyenne = $this->calculerMoyenne();
        $resultat = $moyenne >= 10 ? 'Admis' : 'Non Admis';
        echo "<p>{$this->nom} est {$resultat}</p>";
    }
}

// Création des étudiants
$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];

// Affichage des résultats
foreach ($etudiants as $etudiant) {
    $etudiant->afficherNotes();
    $etudiant->afficherResultat();
    echo "<hr>";
}
?>
