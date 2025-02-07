<div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieModalLabel">Cookies ! 🍪</h5>
            </div>
            <div class="modal-body">
                <p id="cookieTextShort">
                    Ce site utilise des cookies pour améliorer votre expérience. Certains cookies sont nécessaires pour 
                    le bon fonctionnement du site, tandis que d'autres nous aident à l'améliorer. 
                    <a href="#" id="showMoreCookies">En savoir plus...</a>
                </p>
                <p id="cookieTextFull" style="display: none;">
                    Nous utilisons différents types de cookies :
                        <br>  
                        1. Cookies Essentiels (Obligatoires)🔥
                        <br>
                        Ces cookies sont nécessaires au bon fonctionnement du site et ne peuvent pas être désactivés dans nos systèmes. Ils permettent notamment :
                        <br>
                        - La gestion des sessions utilisateurs
                        <br>
                        - La sécurisation du site
                        <br>
                        - La sauvegarde des préférences de langue 
                        <br>
                        <br>
                        2. Cookies Statistiques (Optionnels)🛠️
                        <br>
                        Ces cookies collectent des informations sur l'utilisation du site, comme les pages visitées, le temps passé sur une page et les erreurs rencontrées. Ces données nous aident à améliorer l'expérience utilisateur.
                        <br>
                        💾 Exemples de cookies statistiques :
                        <br>
                        - Suivi du nombre de visites et des interactions
                        <br>
                        - Suivi des sessions quotidiennes
                        <br>
                        📌 Impact si refusé : Nous ne pourrons pas analyser et améliorer les performances du site.
                        <br>
                        <br>
                        3. Cookies Publicitaires (Optionnels) 📨
                        <br>
                        Ces cookies sont utilisés pour afficher des publicités personnalisées en fonction de votre navigation et de vos préférences.
                        <br>
                        💾 Exemples de cookies publicitaires :
                        <br>
                        - Permet le ciblage publicitaire
                        <br>
                        - Suivi des conversions publicitaires
                        <br>
                        - Diffusion d'annonces personnalisées
                        <br>
                        📌 Impact si refusé : Les publicités affichées seront moins pertinentes.
                        <br>
                    <br>
                    Vous pouvez gérer vos préférences et les modifier à tout moment.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="rejectCookies">Refuser</button>
                <button type="button" class="btn btn-primary" id="acceptCookies">Accepter</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cookieModalElement = document.getElementById("cookieModal");
    const cookieModal = new bootstrap.Modal(cookieModalElement);
    const acceptButton = document.getElementById("acceptCookies");
    const rejectButton = document.getElementById("rejectCookies");
    const showMoreButton = document.getElementById("showMoreCookies");
    const shortText = document.getElementById("cookieTextShort");
    const fullText = document.getElementById("cookieTextFull");

    // Vérifier si un choix de cookies a déjà été enregistré
    if (!localStorage.getItem("cookieConsent")) {
        setTimeout(() => {
            cookieModal.show();
        }, 400); // Attendre 500ms avant d'afficher le pop-up
    }

    // Accepter les cookies
    acceptButton.addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "accepted");
        cookieModal.hide();
    });

    // Refuser les cookies
    rejectButton.addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "rejected");
        cookieModal.hide();
    });

    // Afficher le texte complet sur les cookies
    showMoreButton.addEventListener("click", function (e) {
        e.preventDefault();
        shortText.style.display = "none";
        fullText.style.display = "block";
    });
});
</script>
