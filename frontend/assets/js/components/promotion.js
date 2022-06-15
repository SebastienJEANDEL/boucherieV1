const promotion = {
    

 


 

    createPromotionElement: function(newPromotionTitle, newPromotionId, newPromotionAnimal, newPromotionPrice) {
      //  console.log('Creation de la promotion en cours');

        // Get the template, then get the promotion content. Then we clone the task content and finally we get the DOM element, ready to use.
        const promotionCloneElement = document.querySelector('#promotion-template').content.cloneNode(true).firstElementChild;

        // Remplir cet objet task avec le titre et la categorie
        
        promotionCloneElement.dataset.id = newPromotionId;

        promotionCloneElement.querySelector('#promotion-name').textContent = newPromotionTitle;
        promotionCloneElement.querySelector('#promotion-animal-name').textContent = newPromotionAnimal;

        promotionCloneElement.querySelector('#promotion-price').textContent = newPromotionPrice;
        //console.log(promotionCloneElement);
            // Return cet objet
        return promotionCloneElement;
    }
}