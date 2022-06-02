// Component used for everything related to the list of tasks
const tasksList = {
    init: function() {
        console.log('Taskslist init');
        tasksList.loadTasksFromAPI();
    },
    loadTasksFromAPI: function() {
        let fetchOptions = {
            method: 'GET'
        };
        request = fetch(app.apiRootUrl + 'tasks', fetchOptions);
        request.then(
            function(response) {
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                // iterate over all tasks
                jsonResponse.forEach(function(oneTask) {
                    console.log(oneTask);
                    // Creation of DOM task element
                    const newTask = task.createTaskElement(oneTask.title, oneTask.category.name, oneTask.id, oneTask.status);

                    // Insertion of DOM element in current DOM
                    tasksList.insertNewTask(newTask);
                })
            }
        );
    },

    insertNewTask: function(taskElement) {
        // We get the tasks container
        const tasksListContainer = document.querySelector('.tasks');

        // Adding the new task to the top of the list
        tasksListContainer.prepend(taskElement);
        
        // Declaring eventListeners for the new task
        task.bindTaskEvents(taskElement);
    }
}