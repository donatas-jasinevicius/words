(function () {
    angular.module('words')
        .service('wordsStatisticsClient', ['$http', 'BASE_API_URL', function($http, BASE_API_URL) {
            return {
                getWordsListResults: function (wordsListId) {
                    return $http.get(
                        BASE_API_URL + 'words-statistics/words/' + wordsListId
                    );
                },
                saveWordsListResults: function (wordsListId, wordsListResults) {
                    return $http.put(
                        BASE_API_URL + 'words-statistics/words/' + wordsListId,
                        wordsListResults
                    );
                }
            };
        }]);
}());
//todo: ngToast interceptorius