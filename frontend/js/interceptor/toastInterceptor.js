(function () {
    angular.module('words').factory('toastInterceptor', ['$q', 'ngToast', function($q, ngToast) {
        function responseError(response) {
            console.log(response);

            if (
                response.data.hasOwnProperty('error_code')
            ) {
                ngToast.create({
                    content: response.data.error_code//todo: translate
                });
            }

            return $q.reject(response);
        }

        return {
            'responseError': responseError
        };
    }]);
}());

