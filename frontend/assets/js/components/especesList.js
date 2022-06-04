// Component used for everything related to the list of especes
const especesList = {
    init: function() {
        console.log('especeslist init');
        especesList.loadEspecesFromAPI();
    },
    loadEspecesFromAPI: function() {
        let fetchOptions = {
            method: 'GET'
        };
        request = fetch(app.apiRootUrl + 'especes', fetchOptions);
        request.then(
            function(response) {
               
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                // iterate over all tasks
                jsonResponse.forEach(function(oneEspece) {
                   // console.log(oneEspece);
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