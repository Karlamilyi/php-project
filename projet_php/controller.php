<?php
require_once 'database.php';
require_once 'model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'ajouter') {
            $eleve = new Eleve();
            $eleve->nom = $_POST['nom'];
            $eleve->prenom = $_POST['prenom'];
            $eleve->classe = $_POST['classe'];
            $sql = "INSERT INTO eleves (nom, prenom, classe) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $eleve->nom, $eleve->prenom, $eleve->classe);
            $stmt->execute();
        } elseif ($_POST['action'] === 'modifier') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $classe = $_POST['classe'];
            $sql = "UPDATE eleves SET nom = ?, prenom = ?, classe = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nom, $prenom, $classe, $id);
            $stmt->execute();
        } elseif ($_POST['action'] === 'supprimer') {
            $id = $_POST['id'];
            $sql = "DELETE FROM eleves WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
}

function getEleves() {
    global $conn;
    $eleves = array();
    
    $sql = "SELECT * FROM eleves";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eleve = new Eleve();
            $eleve->id = $row['id'];
            $eleve->nom = $row['nom'];
            $eleve->prenom = $row['prenom'];
            $eleve->classe = $row['classe'];
            $eleves[] = $eleve;
        }
    }
    
    return $eleves;
}