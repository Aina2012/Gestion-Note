// Dans popup.js
function showErrorPopup(message) {
    // Créer le contenu du popup
    var popupContent = '<div class="alert alert-danger">' + message + '</div>';

    // Créer le popup
    var popup = document.createElement('div');
    popup.className = 'popup';
    popup.innerHTML = popupContent;

    // Ajouter le popup au body
    document.body.appendChild(popup);

    // Fermer le popup après 5 secondes
    setTimeout(function() {
        document.body.removeChild(popup);
    }, 5000);
}
