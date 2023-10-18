<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestionnaire d'élèves</title>
    <meta name="author" content="mouuuu">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="phone.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <h1>Gestion des élèves</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="ajouter">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prénom">
        <input type="text" name="classe" placeholder="Classe">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Classe</th>
            <th>Actions</th>
        </tr>
        <?php
        $eleves = getEleves();
        foreach ($eleves as $eleve) {
            echo "<tr>";
            echo "<td>{$eleve->nom}</td>";
            echo "<td>{$eleve->prenom}</td>";
            echo "<td>{$eleve->classe}</td>";
            echo "<td>
                    <button onclick='modifierEleve({$eleve->id}," . json_encode($eleve) . ")'>Modifier</button>
                    <button onclick='supprimerEleve({$eleve->id})'>Supprimer</button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <form id="modifierForm" style="display: none;" action="index.php" method="post">
        <input type="hidden" name="action" value="modifier">
        <input type="hidden" name="id" id="id">
        <input type="text" name="nom" id="nom" placeholder="Nom">
        <input type="text" name="prenom" id="prenom" placeholder="Prénom">
        <input type="text" name="classe" id="classe" placeholder="Classe">
        <button type="submit">Enregistrer</button>
    </form>
    
    <script>
        function modifierEleve(id, eleve) {
            document.getElementById('id').value = id;
            document.getElementById('nom').value = eleve.nom;
            document.getElementById('prenom').value = eleve.prenom;
            document.getElementById('classe').value = eleve.classe;
            document.getElementById('modifierForm').style.display = 'block';
        }

        function supprimerEleve(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')) {
                document.getElementById('id').value = id;
                document.getElementById('action').value = 'supprimer';
                document.getElementById('modifierForm').submit();
            }
        }
    </script>
</body>
</html>