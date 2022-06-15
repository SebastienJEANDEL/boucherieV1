const app = {
    apiRootUrl: 'http://localhost:8000/',
    // init execute the startup code needed by our application
    init: function() {
        console.log('app.init launched');
        // all the object we want to init
        
        racesList.init();
        especesList.init();
        promotionsList.init();
        producersList.init();
    }
}

document.addEventListener('DOMContentLoaded', app.init);