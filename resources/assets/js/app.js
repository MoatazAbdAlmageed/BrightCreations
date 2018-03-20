/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var app = angular.module('app', ['ui.router']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.config(function($stateProvider, $urlRouterProvider) {
   $urlRouterProvider.otherwise('home');

    $stateProvider
    // HOME STATES AND NESTED VIEWS ========================================

        .state('home', {
            url: '/home',
            template: '<dashboard></dashboard>'
        })
        .state('post', {
            url: '/post',
            template: '<posts></posts>'
        })

        .state('category', {
            url: '/category',
            template: '<category></category>'
        })

        .state('comment', {
            url: '/comment',
            template: '<comment></comment>'
        })


});