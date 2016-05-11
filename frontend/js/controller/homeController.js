(function () {
    angular.module('words')
        .controller('homeController', ['$scope','wordsLists', 'wordsClient',
            function($scope, wordsLists, wordsClient) {
                $scope.wordsLists = wordsLists;

            var reloadWords = function () {
                wordsClient.getWordsLists().success(function(wordsLists) {
                    $scope.wordsLists = wordsLists;
                });
            };

            $scope.delete = function(wordsListId) {
                wordsClient.deleteWordsLists(wordsListId).success(function () {
                    reloadWords();
                });
            };
        }]);
}());
