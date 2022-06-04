// Component used for everything related to the list of promotions
const promotionsList = {
    init: function() {
        console.log('promotionslist init');
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
                    // Creation of DOM task element
                    //const newTask = task.createTaskElement(oneTask.title, oneTask.category.name, oneTask.id, oneTask.status);

                    // Insertion of DOM element in current DOM
                   // tasksList.insertNewRace(newRace);
                })
            }
        );
    },

    insertNewTask: function(EspeceElement) {

        // We get the tasks container
       // const tasksListContainer = document.querySelector('.tasks');

        // Adding the new task to the top of the list
       // tasksListContainer.prepend(taskElement);
        
        // Declaring eventListeners for the new task
       // task.bindTaskEvents(taskElement);
    }
}