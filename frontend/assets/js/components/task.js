const task = {
    
    // used to activate all eventListeners on a task
    bindTaskEvents: function(taskElement) {
        // eventlistener on title click

        // Contain the DOM title object
        const taskTitleElement = taskElement.querySelector('.task__title-label');

        // When I click on a task title, execute enableTaskTitleEdit
        taskTitleElement.addEventListener('click', task.enableTaskTitleEdit);


        // EventListener on blur or enter key

        // Contain the DOM title input object
        const taskTitleInputElement = taskElement.querySelector('.task__title-field');

        // When I lose focus on the input
        //@TODO attention, cet event listener s'execute même apres apres appuyé sur entrée
        taskTitleInputElement.addEventListener('blur', task.disableTaskTitleEdit);

        // When I press the enter key
        taskTitleInputElement.addEventListener('keydown', task.disableTaskTitleEditOnKeydown);

        // EventListener on success button click
        const taskSuccessButtonElement = taskElement.querySelector('.task__button--validate');

        taskSuccessButtonElement.addEventListener('click', task.markTaskAsCompleted);

        // EventListener on incomplete button click
        const taskIncompleteButtonElement = taskElement.querySelector('.task__button--incomplete');

        taskIncompleteButtonElement.addEventListener('click', task.markTaskAsIncomplete)
    },
    markTaskAsIncomplete: function(event) {
        // We get the incomplete button object
        const taskTitleElement = event.currentTarget;

        // With closest, we get the first parent containing .task
        const taskElement = taskTitleElement.closest('.task');

        const taskId = taskElement.dataset.id;
        const requestData = {
            "completion": 0,
            "status": 0
        };

        // We instanciate a new Header object to add headers to our request
        const httpHeaders = new Headers();
        httpHeaders.append('Content-Type', 'application/json');


        let fetchOptions = {
            method: 'PATCH',
            headers: httpHeaders,
            body: JSON.stringify(requestData)
        };
        request = fetch(app.apiRootUrl + 'tasks/' + taskId, fetchOptions);
        request.then(
            function(response) {
                console.log(response.status);
                if(response.status === 200) {
                    taskElement.classList.remove('task--complete');
                    taskElement.classList.add('task--todo');
                } else {
                    alert('Erreur lors de l\'update de la tache');
                }
            }
        )
    },
    markTaskAsCompleted: function(event) {
        // We get the success button object
        const taskTitleElement = event.currentTarget;

        // With closest, we get the first parent containing .task
        const taskElement = taskTitleElement.closest('.task');

        const taskId = taskElement.dataset.id;
        const requestData = {
            "completion": 100,
            "status": 1
        };

        // We instanciate a new Header object to add headers to our request
        const httpHeaders = new Headers();
        httpHeaders.append('Content-Type', 'application/json');


        let fetchOptions = {
            method: 'PATCH',
            headers: httpHeaders,
            body: JSON.stringify(requestData)
        };
        request = fetch(app.apiRootUrl + 'tasks/' + taskId, fetchOptions);
        request.then(
            function(response) {
                console.log(response.status);
                if(response.status === 200) {
                    taskElement.classList.remove('task--todo');
                    taskElement.classList.add('task--complete');
                } else {
                    alert('Erreur lors de l\'update de la tache');
                }
            }
        )
    },

    enableTaskTitleEdit: function(event) {
        // We get the title object
        const taskTitleElement = event.currentTarget;

        // With closest, we get the first parent containing .task
        const taskElement = taskTitleElement.closest('.task');

        // We add task--edit to the parent to enable edition
        taskElement.classList.add('task--edit');

    },
    disableTaskTitleEditOnKeydown: function(event) {
        if(event.code === 'Enter') {
            task.disableTaskTitleEdit(event);
        }
    },

    disableTaskTitleEdit: function(event) {

        const taskTitleInputElement = event.currentTarget;

        // We store the new value of our input
        const newTaskTitle = taskTitleInputElement.value;
        // With closest, we get the first parent containing .task
        const taskElement = taskTitleInputElement.closest('.task');

        const taskId = taskElement.dataset.id;

        const requestData = {
            "title": newTaskTitle
        };

        // We instanciate a new Header object to add headers to our request
        const httpHeaders = new Headers();
        httpHeaders.append('Content-Type', 'application/json');


        let fetchOptions = {
            method: 'PATCH',
            headers: httpHeaders,
            body: JSON.stringify(requestData)
        };
        request = fetch(app.apiRootUrl + 'tasks/' + taskId, fetchOptions);
        request.then(
            function(response) {
                console.log(response.status);
                if(response.status === 200) {
                    // We get the task title and update its content with our input value
                    taskElement.querySelector('.task__title-label').textContent = newTaskTitle;

                    // We add task--edit to the parent to disable edition
                    taskElement.classList.remove('task--edit');
                } else {
                    alert('Erreur lors de l\'update de la tache');
                }
            }
        )
    },

    createTaskElement: function(newTaskTitle, newTaskCategory, newTaskId, newTaskStatus) {
        console.log('Creation de la tache en cours');

        // Get the template, then get the task content. Then we clone the task content and finally we get the DOM element, ready to use.
        const taskCloneElement = document.querySelector('#task-template').content.cloneNode(true).firstElementChild;

        // Remplir cet objet task avec le titre et la categorie
        taskCloneElement.dataset.category = newTaskCategory;
        taskCloneElement.dataset.id = newTaskId;

        taskCloneElement.querySelector('.task__title-label').textContent = newTaskTitle;
        taskCloneElement.querySelector('.task__title-field').value = newTaskTitle;

        taskCloneElement.querySelector('.task__category p').textContent = newTaskCategory;

        if(newTaskStatus === 1) {
            taskCloneElement.className = 'task task--complete';
        } else if(newTaskStatus === 2) {
            taskCloneElement.className = 'task task--archive';
        }

        // Return cet objet
        return taskCloneElement;
    }
}