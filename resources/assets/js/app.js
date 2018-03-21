/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


var app = angular.module('app', ['ui.router']
    , ['$httpProvider', function ($httpProvider) {
        // $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.config(function ($stateProvider, $urlRouterProvider) {

    $stateProvider
        .state('admin', {
            url: '/admin',
            template: '<dashboard></dashboard>',
        })
        .state('postManager', {
            url: '/admin/post',
            template: '<posts></posts>'
        })
        .state('categoryManager', {
            url: '/admin/category',
            template: '<category></category>'
        })
        .state('commentManager', {
            url: '/admin/comment',
            template: '<comment></comment>'
        })

    $urlRouterProvider.otherwise('admin');

});