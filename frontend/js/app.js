const app = {
    // URL de base de notre API
    apiBaseUri : 'http://localhost:8000',

    // <select> des jeux
    videogameSelectElt : null,

    init: function() {
        console.log('app.init()');

        // On récupère l'élément <select> des jeux vidéo
        app.videogameSelectElt = document.querySelector('#videogameId');

        // On appelle la méthode s'occupant d'ajouter les EventListener sur les éléments déjà dans le DOM
        app.addAllEventListeners();

        // On appelle la méthode s'occupant de charger tous les jeux vidéo
        app.loadVideoGames();
    },
    addAllEventListeners: function() {
        // On ajoute l'écouteur pour l'event "change", et on l'attache à la méthode app.handleVideogameSelected
        app.videogameSelectElt.addEventListener('change', app.handleVideogameSelected);

        // On récupère le bouton pour ajouter un jeu vidéo
        const addVideogameButtonElement = document.getElementById('btnAddVideogame');
        // On ajoute l'écouteur pour l'event "click"
        addVideogameButtonElement.addEventListener('click', app.handleClickToAddVideogame);
        
        // On récupère le formulaire pour ajouter un jeu vidéo
        const addVideogameFormElt = document.querySelector('#addVideogameForm');
        // On ajoute l'écouteur pour l'event "submit"
        addVideogameFormElt.addEventListener('submit', app.handleSubmitToAddVideogame);
    },
    handleVideogameSelected: function(evt) {
        // Récupérer la valeur du <select> (id du videogame)
        const videogameId = evt.target.value;

        // Vider le contenu de div#review
        const reviewsContainerElt = document.querySelector('#review');
        reviewsContainerElt.innerHTML = '';

        // On récupère le template des reviews car on en aura besoin un peu plus tard
        const reviewTemplateElt = document.querySelector('#reviewTemplate');

        // On charge les données des reviews pour ce videogame
        fetch(app.apiBaseUri + '/videogames/' + videogameId + '/reviews')
            // Quand l'API renvoie les données...
            .then(function (response) {
                // ...on convertit la réponse JSON en objet JS
                return response.json();
            })
            // Ensuite on gère les reviews
            .then(function (reviews) {
                // Pour chaque review...
                for (let review of reviews) {
                    // ...on crée une copie du contenu du template
                    const reviewElt = reviewTemplateElt.content.cloneNode(true);

                    // ...puis on injecte les données de l'API dans le DOM
                    reviewElt.querySelector('.reviewTitle').append(review.title);
                    reviewElt.querySelector('.reviewAuthor').append(review.author);
                    reviewElt.querySelector('.reviewPublication').append(review.publication_date);
                    reviewElt.querySelector('.reviewText').append(review.text);
                    reviewElt.querySelector('.reviewDisplay').append(review.display_note);
                    reviewElt.querySelector('.reviewGameplay').append(review.gameplay_note);
                    reviewElt.querySelector('.reviewScenario').append(review.scenario_note);
                    reviewElt.querySelector('.reviewLifetime').append(review.lifetime_note);

                    reviewElt.querySelector('.reviewVideogame').append(review.videogame.name);
                    reviewElt.querySelector('.reviewEditor').append(review.videogame.editor);
                    reviewElt.querySelector('.reviewPlatform').append(review.platform.name);

                    // ...et enfin on ajoute la review à la liste
                    reviewsContainerElt.append(reviewElt);
                }
            });
    },
    handleClickToAddVideogame: function(evt) {
        // https://getbootstrap.com/docs/4.4/components/modal/#modalshow
        // jQuery obligatoire ici
        $('#addVideogameModal').modal('show');
    },
    handleSubmitToAddVideogame: function (evt) {
        // On empêche le formulaire de recharger la page
        evt.preventDefault();

        // On récupère les <input> du formulaire
        const nameInputElt = evt.target.querySelector('#inputName');
        const editorInputElt = evt.target.querySelector('#inputEditor');

        // On prépare les données à envoyer à l'API
        const videogame = {
            name: nameInputElt.value,
            editor: editorInputElt.value
        };

        // On récupère les containers des messages de succès ou d'échec (on en aura besoin)
        const successElt = document.querySelector('#addVideogameSuccess')
        const failElt = document.querySelector('#addVideogameFail')

        // On envoie les données à l'API
        fetch(app.apiBaseUri + '/videogames', {
            // la méthode de la requête sera POST
            method: 'POST',
            headers: {
                // il faut spécifier au serveur qu'on lui envoie du JSON
                'Content-Type': 'application/json'
            },
            // on pense à convertir l'objet JS en JSON
            body: JSON.stringify(videogame)
        })
            // Quand l'API répond...
            .then(function (response) {
                // Si le statut de la réponse est 201 (Created) => tout s'est bien passé
                if (response.status === 201) {
                    // On masque et vide l'éventuel message d'erreur
                    failElt.classList.add('d-none');
                    failElt.textContent = '';
    
                    // On affiche un message de confirmation
                    successElt.textContent = "Le jeu vidéo a bien été ajouté !";
                    successElt.classList.remove('d-none');

                    // On ferme la fenête modale
                    // https://getbootstrap.com/docs/4.4/components/modal/#modalshow
                    // jQuery obligatoire ici
                    $('#addVideogameModal').modal('hide');

                    // On récupère le contenu JSON de la réponse...
                    response.json()
                        .then(function (videogame) {
                            // ...pour ajouter une nouvelle <option> au <select>
                            const option = new Option(videogame.name, videogame.id);
                            /**
                             * On peut aussi faire avec la méthode traditionnelle :
                             * 
                             * const option = document.createElement('option');
                             * option.textContent = videogame.name;
                             * option.value = videogame.id;
                             */

                            app.videogameSelectElt.append(option);
                        });
    
                    // (facultatif) On vide les champs du formulaire pour pouvoir ajouter un nouveau videogame
                    nameInputElt.value = '';
                    editorInputElt.value = '';
                }
                // Sinon, il l'entregistrement a échoué
                else {
                    // On masque et vide l'éventuel message de succès
                    successElt.classList.add('d-none');
                    successElt.textContent = '';
    
                    // On affiche un message d'erreur
                    failElt.textContent = "Oups ! Le jeu vidéo n'a pas pu être ajouté.";
                    failElt.classList.remove('d-none');
                }
            });
    },
    loadVideoGames: function() {
        // Charger toutes les données des videogames
        fetch(app.apiBaseUri + '/videogames')
            // On convertit la réponse JSON en objet JS
            .then(function (response) {
                return response.json();
            })
            // Ajouter une balise <option> par videogame
            .then(function (videogames) {
                // Pour chaque videogame...
                for (let videogame of videogames) {
                    // ...on crée une <option>
                    const option = new Option(videogame.name, videogame.id);
                    /**
                     * On peut aussi faire avec la méthode traditionnelle :
                     * 
                     * const option = document.createElement('option');
                     * option.textContent = videogame.name;
                     * option.value = videogame.id;
                     */

                    // ...et on l'ajoutz au <select id="videogameId">
                    app.videogameSelectElt.append(option);
                }
            });
    }
};

document.addEventListener('DOMContentLoaded', app.init);
