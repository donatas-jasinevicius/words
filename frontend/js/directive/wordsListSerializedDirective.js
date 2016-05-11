(function () {
    angular.module('words')
        .directive('wordsListSerialized', ['$parse', function($parse) {
            return {
                restrict: 'A',
                require: '?ngModel',
                scope: {
                    ngModel: '=',
                    useDeserializer: '='
                },
                link: function(scope, element, attrs, ngModel) {
                    if (!ngModel) {
                        return;
                    }
                    function serialize(words) {
                        var serializedWordsList = [];

                        angular.forEach(words, function(word) {
                            var tmp = word.original;

                            angular.forEach(word.translations, function(translation) {
                                tmp += ';' + translation.translation;
                            });

                            serializedWordsList.push(tmp);
                        });

                        return serializedWordsList.join('\n');
                    }

                    function deserialize(serializedWords) {
                        if (!scope.useDeserializer) {
                            return ngModel.$modelValue;
                        }

                        var words = [];
                        var lines = serializedWords.split("\n");

                        angular.forEach(lines, function(value) {
                            var words = value.split(";");
                            var original = words[0];
                            words.splice(0, 1);

                            var wordsObjects = [];
                            angular.forEach(words, function(word) {
                                wordsObjects.push({translation: word});
                            });
                            this.push({original: original, translations: wordsObjects});
                        }, words);

                        return words;
                    }

                    scope.$watch(
                        function() {
                            return ngModel.$modelValue;
                        },
                        function(modelValue) {
                            ngModel.$setViewValue(serialize(modelValue));
                            ngModel.$render();
                        },
                        true
                    );

                    ngModel.$parsers.push(deserialize);
                    ngModel.$formatters.push(serialize);
                }
            }
        }]);
}());
