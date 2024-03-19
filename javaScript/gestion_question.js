function masquerQuestion(id) {
    if (confirm("Êtes-vous sûr de vouloir masquer cette question?")) {
        // Mettre à jour l'affichage pour masquer la question
        var row = document.getElementById("row_" + id);
        row.style.display = "none";
        // Mettre à jour la base de données ici pour masquer la question
        // Vous pouvez ajouter du code JavaScript pour envoyer une requête AJAX et mettre à jour la base de données
    }
}

function supprimerQuestion(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette question?")) {
        // Supprimer la question de l'affichage
        var row = document.getElementById("row_" + id);
        row.parentNode.removeChild(row);
        // Supprimer la question de la base de données ici
        // Vous pouvez ajouter du code JavaScript pour envoyer une requête AJAX et supprimer la question de la base de données
    }
}