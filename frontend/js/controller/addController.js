(function () {
    angular.module('words')
        .controller('addController', ['$scope', 'wordsStorage', 'wordsClient', '$routeParams', '$location', 'wordsList',
            function($scope, wordsStorage, wordsClient, $routeParams, $location, wordsList) {
                $scope.listId = null;
                if ($routeParams.listId !== undefined) {
                    $scope.listId = $routeParams.listId;
                }

                $scope.wordsList = wordsList;

                //todo: remove
                $scope.wordsList.words.push({original: 'cake', translations: [{translation: 'tortas'}]});

                $scope.removeTranslation = function(wordIndex, translationIndex) {
                    $scope.wordsList.words[wordIndex].translations.splice(translationIndex, 1);
                };

                $scope.removeWord = function(wordIndex) {
                    $scope.wordsList.words.splice(wordIndex, 1);
                };

                $scope.addTranslation = function (wordIndex) {
                    $scope.wordsList.words[wordIndex].translations.push({translation: ''});
                };

                $scope.addWord = function () {
                    $scope.wordsList.words.push({original: '', translations: [{translation: ''}]});
                };

                $scope.save = function () {
                    if ($scope.listId === null) {
                        wordsClient.saveWordsList($scope.wordsList).success(function () {
                            $location.path('/');
                        });
                    } else {
                        wordsClient.updateWordsList($scope.listId, $scope.wordsList).success(function () {
                            $location.path('/');
                        });
                    }
                };
            }]);
}());
