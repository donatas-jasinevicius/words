(function () {
    angular.module('words')
        .service('resultsStorage', function () {
            var wordsListResults = null;

            return {
                addWordResult: function (word, correct) {
                    var found = false;
                    var wordResult = null;
                    angular.forEach(wordsListResults.words_results, function(result) {
                        if (result.word.id === word.id) {
                            wordResult = result;
                            found = true;
                        }
                    });

                    if (!found) {
                        wordResult = {
                            word: word,
                            correct_count: 0,
                            incorrect_count: 0
                        };

                        wordsListResults.words_results.push(wordResult);
                    }

                    if (correct) {
                        wordResult.correct_count++;
                    } else {
                        wordResult.incorrect_count++;
                    }
                },
                getWordsListResults: function () {
                    return wordsListResults;
                },
                init: function (wordsListId) {
                    wordsListResults = {
                        words_list: {
                            id: wordsListId
                        },
                        words_results: []
                    };
                }
            };
        });
}());
