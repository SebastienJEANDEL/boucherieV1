// Component used for everything related to the list of races
const racesList = {
    init: function() {
        console.log('raceslist init');
        racesList.loadRacesFromAPI();
    },
    loadRacesFromAPI: function() {
        let fetchOptions = {
            method: 'GET'
        };
        request = fetch(app.apiRootUrl + 'races', fetchOptions);
        request.then(
            function(response) {
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                // iterate over all tasks
                jsonResponse.forEach(function(oneRace) {
                   // console.log(oneRace);
                    // Creation of DOM task element
                    //const newTask = task.createTaskElement(oneTask.title, oneTask.category.name, oneTask.id, oneTask.status);

                    // Insertion of DOM element in current DOM
                   // tasksList.insertNewRace(newRace);
                })
            }
        );
    },

    insertNewTask: function(RaceElement) {

        // We get the tasks container
       // const tasksListContainer = document.querySelector('.tasks');

        // Adding the new task to the top of the list
       // tasksListContainer.prepend(taskElement);
        
        // Declaring eventListeners for the new task
       // task.bindTaskEvents(taskElement);
    }
}