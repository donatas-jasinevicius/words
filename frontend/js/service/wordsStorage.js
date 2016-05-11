(function () {
    angular.module('words')
        .service('wordsStorage', function () {
            var words = null;

            return {
                setWords: function (value) {
                    words = value;
                },
                getWords: function () {
                    if (words == null) {
                        return null;
                    }

                    return words.slice(0);
                }
            };
        });
}());
