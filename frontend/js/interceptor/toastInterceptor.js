(function () {
    angular.module('words').factory('toastInterceptor', ['$q', 'ngToast', function($q, ngToast) {
        function responseError(response) {
            if (
                response.status > 0
                && response.data.hasOwnProperty('error_code')
            ) {
                ngToast.create({
                    content: response.data.error_code//todo: translate errors
                });
            }

            return $q.reject(response);
        }

        return {
            'responseError': responseError
        };
    }]);
}());

