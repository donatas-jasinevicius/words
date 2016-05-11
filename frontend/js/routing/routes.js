(function () {
    angular.module('words')
        .config(['$routeProvider', function($routeProvider) {
            $routeProvider
                .when('/', {
                    templateUrl : 'templates/home.html',
                    controller  : 'homeController',
                    resolve: {
                        wordsLists: ['wordsClient', function (wordsClient) {
                            return wordsClient.getWordsLists().then(function (response) {
                                return response.data;
                            });
                        }]
                    }
                })
                .when('/add', {
                    templateUrl : 'templates/add.html',
                    controller  : 'addController',
                    resolve: {
                        wordsList: function () {
                            return {name: '', words: []};
                        }
                    }
                })
                .when('/edit/:listId', {
                    templateUrl : 'templates/add.html',
                    controller  : 'addController',
                    resolve: {
                        wordsList: ['wordsClient', '$route', function (wordsClient, $route) {
                            return wordsClient.getWordsList($route.current.params.listId).then(function (response) {
                                return response.data;
                            });
                        }]
                    }
                })
                .when('/play/:listId', {
                    templateUrl : 'templates/play.html',
                    controller  : 'playController',
                    resolve: {
                        wordsList: ['wordsClient', '$route', function (wordsClient, $route) {
                            return wordsClient.getWordsList($route.current.params.listId).then(function (response) {
                                return response.data;
                            });
                        }]
                    }
                })
                .when('/results', {
                    templateUrl : 'templates/results.html',
                    controller  : 'resultController'
                })
                .otherwise({
                    redirectTo:'/'
                });
            }]
        );

}());
