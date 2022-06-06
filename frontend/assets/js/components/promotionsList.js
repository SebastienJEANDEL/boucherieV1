// Component used for everything related to the list of promotions
const promotionsList = {
    init: function() {
        console.log('promotionslist init ');
        promotionsList.loadPromotionsFromAPI();
    },
    loadPromotionsFromAPI: function() {
        
        let fetchOptions = {
            method: 'GET'
        };
        request = fetch(app.apiRootUrl + 'promotions', fetchOptions);
        request.then(
            function(response) {
                
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
               
                // iterate over all tasks
                jsonResponse.forEach(function(onePromotion) {
                    console.log(onePromotion);
                    // Creation of DOM promotion element
                    const newPromotion = promotion.createPromotionElement(onePromotion.piece_name, onePromotion.id, onePromotion.animal_id, onePromotion.price );

                    // Insertion of DOM element in current DOM
                    promotionsList.insertNewPromotion(newPromotion);
                })
            },
        );
    },

    insertNewPromotion: function(promotionElement) {

        // We get the promotions container
        const promotionsListContainer = document.querySelector('.promotions');

        // Adding the new promotion to the top of the list
        promotionsListContainer.prepend(promotionElement);
        
        // Declaring eventListeners for the new promotion
       // promotion.bindTaskEvents(promotionElement);
    },
}
