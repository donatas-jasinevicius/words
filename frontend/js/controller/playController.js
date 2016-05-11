(function () {
    angular.module('words')
        .controller('playController', ['$scope', 'wordsStatisticsClient', 'wordsList', '$location', 'resultsStorage',
        function($scope, wordsStatisticsClient, wordsList, $location, resultsStorage) {
            //todo: implement different learning strategies
            var init = function () {
                $scope.words = wordsList.words;
                $scope.totalWords = $scope.words.length;
                $scope.currentWord = null;
                $scope.showingAnswer = false;
                $scope.voice = false;
                $scope.failedWords = [];

                resultsStorage.init(wordsList.id);

                $scope.showWord();
            };

            $scope.showWord = function () {
                $scope.showingAnswer = false;
                $scope.currentWord = getWord();
            };

            $scope.iKnewIt = function () {
                resultsStorage.addWordResult($scope.currentWord, true);
                $scope.showWord();
            };

            $scope.iWillKnowIt = function () {
                resultsStorage.addWordResult($scope.currentWord, false);
                $scope.failedWords.push($scope.currentWord);
                $scope.showWord();
            };

            $scope.showAnswer = function () {
                if ($scope.voice) {
                    responsiveVoice.speak($scope.currentWord.original);
                }
                $scope.showingAnswer = true;
            };

            $scope.spellWord = function () {
                responsiveVoice.speak($scope.currentWord.original);
            };

            var getWord = function () {//todo: move to service
                if ($scope.words.length == 0) {
                    if ($scope.failedWords.length == 0) {
                        //todo: shows empty word, while trying to load
                        wordsStatisticsClient.saveWordsListResults(wordsList.id, resultsStorage.getWordsListResults())
                        .success(function () {
                            $location.path( "/results" );
                        });

                        return;
                    }
                    $scope.words = $scope.failedWords;
                    $scope.failedWords = [];
                }
                var index = Math.round(Math.random() * ($scope.words.length - 1));
                var word = $scope.words[index];
                $scope.words.splice(index, 1);

                console.log(word);

                return word;
            };

            init();

        }]);
}());



