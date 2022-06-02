const newTaskForm = {
    init: function() {
        newTaskForm.bindSubmitEvent();
    },

    bindSubmitEvent: function() {
        const newTaskFormElement = document.querySelector('.task--add form');

        newTaskFormElement.addEventListener('submit', newTaskForm.handleNewTaskSubmit);
    },

    handleNewTaskSubmit: function(event) {

        // Prevent form submission
        event.preventDefault();

        // we get the form object
        const newTaskFormElement = event.currentTarget;

        // Get the form title
        const formTitleElement = newTaskFormElement.querySelector('.task__title-field');
        const formTitleValue = formTitleElement.value

        // Get the form category
        const formCategoryElement = newTaskFormElement.querySelector('.task__category .select select');
        const formCategoryId = formCategoryElement.value;

        //const formCategoryName = formCategoryElement[formCategoryId].textContent;

        const requestData = {
            "title": formTitleValue,
            "completion": 0,
            "status": 0,
            "categoryId": formCategoryId
        }
        const httpHeaders = new Headers();
        httpHeaders.append('Content-Type', 'application/json');


        let fetchOptions = {
            method: 'POST',
            headers: httpHeaders,
            body: JSON.stringify(requestData)
        };
        request = fetch(app.apiRootUrl + 'tasks', fetchOptions);
        request.then(
            function(response) {
                console.log(response.status);
                if(response.status === 201) {
                    return response.json();
                } else {
                    alert('Erreur lors de la création de la tache');
                }
            }
        )
        .then(
            function(responseJson) {
                //@TODO Attention a verifier la présence de responseJson avant d'inserer
                // la nouvelle tache
                
                // Creation of a new task with custom title and category
                const newTaskObject = task.createTaskElement(responseJson.title, responseJson.category.name, responseJson.id, responseJson.status );

                // Insertion of the new task in the tasks list
                tasksList.insertNewTask(newTaskObject);
            }
        )


    }
}