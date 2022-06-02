const categoriesList = {
    init: function() {
        categoriesList.loadCategoriesFromAPI();
    },

    loadCategoriesFromAPI: function() {
        console.log('categories loading started');
        let fetchOptions = {
            method: 'GET'
        };
        request = fetch(app.apiRootUrl + 'categories', fetchOptions);
        request.then(
            function(response) {
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                console.log(jsonResponse);
                const selectFilter = categoriesList.createSelectElement(jsonResponse, "Toutes les catégories", "filters__choice");
                document.querySelector('.filters .filters__task--category').append(selectFilter);

                const selectForm = categoriesList.createSelectElement(jsonResponse, "Choisir une catégorie");
                document.querySelector('.task--add .task__category .select').append(selectForm);
            }
        );
    },

    createSelectElement: function(categories, optionDefaultValue, selectClass = '') {
        // Creation of select node object
        const selectElement = document.createElement('select');
        if(selectClass != '') {
            selectElement.classList.add(selectClass);
        }

        // Creation of default option
        const defaultOption = document.createElement('option');
        defaultOption.textContent = optionDefaultValue;

        // We add the default option to the select node
        selectElement.append(defaultOption);

        // For each category returned by the API
        categories.forEach(function(category) {
            // We create a new option node
            const optionElement = document.createElement('option');
            // Get the category name property
            optionElement.textContent = category.name;
            // Add the category ID
            optionElement.value = category.id; 
            // And insert the option in our select
            selectElement.append(optionElement);
        });
        return selectElement;
    }
}