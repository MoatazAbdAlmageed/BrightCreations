
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//
// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

// import './bootstrap';
import 'angular';

var app = angular.module('LaravelCRUD', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('PostController', ['$scope', '$http', function ($scope, $http) {

    $scope.posts = [];

    // List posts
    $scope.loadPosts = function () {
        $http.get('/post')
            .then(function success(e) {
                $scope.posts = e.data.posts;
                
            });
    };
    $scope.loadPosts();


    $scope.errors = [];

    $scope.post = {
        name: '',
        description: ''
    };
    $scope.initPost = function () {
        
        $scope.resetForm();
        $("#add_new_post").modal('show');
    };

    // Add new Post
    $scope.addPost = function () {
        $http.post('/post', {
            title: $scope.post.title,
            description: $scope.post.description
        }).then(function success(e) {
            $scope.resetForm();
            $scope.posts.push(e.data.post);
            $("#add_new_post").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.recordErrors = function (error) {
        debugger
        $scope.errors = [];
        if (error.data.errors.title) {
            $scope.errors.push(error.data.errors.title[0]);
        }

        if (error.data.errors.description) {
            $scope.errors.push(error.data.errors.description[0]);
        }
    };

    $scope.resetForm = function () {
        $scope.post.name = '';
        $scope.post.description = '';
        $scope.errors = [];
    };



    // initialize update action
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_post = $scope.posts[index];
        $("#edit_post").modal('show');
    };

    // update the given post
    $scope.updatePost = function () {
        $http.patch('/post/' + $scope.edit_post.id, {
            title: $scope.edit_post.title,
            description: $scope.edit_post.description
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_post").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };


    $scope.deletePost = function (index) {

        var conf = confirm("Do you really want to delete this post?");

        if (conf === true) {
            $http.delete('/post/' + $scope.posts[index].id)
                .then(function success(e) {
                    $scope.posts.splice(index, 1);
                });
        }
    };


}]);