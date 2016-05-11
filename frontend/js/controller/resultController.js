(function () {
    angular.module('words')
        .controller('resultController', ['$scope', 'wordsStorage', '$location', 'resultsStorage',
        function($scope, wordsStorage, $location, resultsStorage) {
            var init = function () {
                $scope.wordsListResults = resultsStorage.getWordsListResults();
                if ($scope.wordsListResults === null) {
                    $location.path( "/" );
                    return;
                }

                $scope.failedWordsCount = 0;
                angular.forEach($scope.wordsListResults.words_results, function(wordResult) {
                    if (wordResult.incorrect_count > 0) {
                        $scope.failedWordsCount++;
                    }
                });

                $scope.wordsCount = $scope.wordsListResults.words_results.length;
                $scope.correctCount = $scope.wordsCount - $scope.failedWordsCount;
                $scope.correctPercent = Math.round(($scope.correctCount) / $scope.wordsCount * 100);
            };

            init();
        }]);
}());
