(function () {
    angular.module('words')
        .directive('wordsListResults', ['wordsStatisticsClient', function(wordsStatisticsClient) {
            return {
                restrict: 'E',
                templateUrl: 'templates/wordsListResult.html',
                scope: {
                    wordsListId: '='
                },
                link: function(scope) {
                    scope.correctCount = 0;
                    scope.incorrectCount = 0;
                    scope.loading = true;

                    wordsStatisticsClient.getWordsListResults(scope.wordsListId).success(function (wordsListResults) {
                        console.log(wordsListResults);
                        angular.forEach(wordsListResults.words_results, function(wordResult) {
                            scope.correctCount += wordResult.correct_count;
                            scope.incorrectCount += wordResult.incorrect_count;
                        });
                        scope.loading = false;
                    });
                }
            }
        }]);
}());
