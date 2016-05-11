(function () {
    'use strict';
    var words = angular.module('words', ['ngRoute', 'ngToast', 'ngAnimate'])
        .config(['$httpProvider', function($httpProvider) {
            $httpProvider.interceptors.push('HttpRequestTimeoutInterceptor');
            $httpProvider.interceptors.push('httpLoaderInterceptor');
            $httpProvider.interceptors.push('toastInterceptor');

        }])
        .config(['ngToastProvider', function(ngToastProvider) {
            ngToastProvider.configure({
                animation: 'fade' // or 'fade'
            });
        }])
        .constant('BASE_API_URL', '/backend/api/')
        .run(function ($rootScope, HttpPendingRequestsService) {
            $rootScope.$on('$locationChangeSuccess', function (event, newUrl, oldUrl) {
                if (newUrl !== oldUrl) {
                    HttpPendingRequestsService.cancelAll();
                }
            })
        });
}());
