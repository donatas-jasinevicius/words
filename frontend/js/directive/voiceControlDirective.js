(function () {
    angular.module('words')
        .directive('voiceControl', function () {
            return {
                restrict: 'E',
                templateUrl: 'templates/voiceControl.html',
                scope: {
                    voice: '='
                },
                link: function(scope, element) {
                    var buttonElement = $(element).find('.voice-toggle');

                    if (scope.voice) {
                        buttonElement.addClass('fa-volume-up');
                    } else {
                        buttonElement.addClass('fa-volume-off');
                    }

                    scope.toggleVoice = function () {
                        if (scope.voice) {
                            buttonElement.removeClass('fa-volume-up').addClass('fa-volume-off');
                        } else {
                            buttonElement.removeClass('fa-volume-off').addClass('fa-volume-up');
                        }
                        scope.voice = !scope.voice;
                    };
                }
            }
        });
}());