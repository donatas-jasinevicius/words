(function () {
    angular.module('words').factory('httpLoaderInterceptor', ['$rootScope', '$q', function($rootScope, $q) {
        var requestCount = 0;

        function request(config) {
            if(!requestCount) {
                NProgress.start();
            }
            requestCount++;

            return config;
        }

        function response(response) {
            if(requestCount) {
                requestCount--;

                if(!requestCount) {
                    NProgress.done();
                }
            }

            return response;
        }

        function error(response) {
            if(requestCount) {
                requestCount--;

                if(!requestCount) {
                    NProgress.done();
                }
            }

            return $q.reject(response);
        }

        return {
            'request': request,
            'response': response,
            'requestError': error,
            'responseError': error
        };
    }]);
}());

