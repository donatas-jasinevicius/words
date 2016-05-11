(function () {
    angular.module('words')
        .service('wordsClient', ['$http', 'BASE_API_URL', function($http, BASE_API_URL) {
            return {
                getWordsLists: function () {
                    return $http.get(
                        BASE_API_URL + 'words/words'
                    );
                },
                getWordsList: function (wordsListId) {
                    return $http.get(
                        BASE_API_URL + 'words/words/' + wordsListId
                    );
                },
                updateWordsList: function (wordsListId, wordsList) {
                    return $http.put(
                        BASE_API_URL + 'words/words/' + wordsListId,
                        wordsList
                    );
                },
                saveWordsList: function (wordsList) {
                    return $http.post(
                        BASE_API_URL + 'words/words',
                        wordsList
                    );
                },
                deleteWordsLists: function (wordsListId) {
                    return $http.delete(
                        BASE_API_URL + 'words/words/' + wordsListId
                    );
                }
            };
        }]);
}());
