angular.module('app').component('posts', {
    bindings: {
        data: '='
    },
    templateUrl: 'js/component/post/view.html',
    controller: function ($http) {
        var ctrl = this;
        ctrl.posts = [];
        // List posts
        ctrl.loadPosts = function () {
            $http.get('/post')
                .then(function success(e) {
                    ctrl.posts = e.data.posts;
                    ctrl.comments = e.data.comments;

                });
        };

        ctrl.loadCategories = function () {
            $http.get('/category')
                .then(function success(e) {

                    ctrl.categories = e.data.categories;

                });
        };

        ctrl.loadPosts();
        ctrl.loadCategories();

        ctrl.errors = [];

        ctrl.post = {
            name: '',
            description: '',
            category_id: '',
        };
        ctrl.initPost = function () {

            ctrl.resetForm();
            $("#add_new_post").modal('show');
        };
        ctrl.$onInit = function() {

        };
        // Add new Post
        ctrl.addPost = function () {
            $http.post('/post', {
                title: ctrl.post.title,
                description: ctrl.post.description,
                category_id: ctrl.post.category_id,
            }).then(function success(e) {
                ctrl.resetForm();
                ctrl.posts.push(e.data.post);
                $("#add_new_post").modal('hide');

            }, function error(error) {
                ctrl.recordErrors(error);
            });
        };

        ctrl.recordErrors = function (error) {

            ctrl.errors = [];
            if (error.data.errors.title) {
                ctrl.errors.push(error.data.errors.title[0]);
            }

            if (error.data.errors.description) {
                ctrl.errors.push(error.data.errors.description[0]);
            }
        };

        ctrl.resetForm = function () {
            ctrl.post.name = '';
            ctrl.post.description = '';
            ctrl.post.category_id = '';
            ctrl.errors = [];
        };


        // initialize update action
        ctrl.initEdit = function (index) {
            ctrl.errors = [];
            ctrl.edit_post = angular.copy(ctrl.posts[index]);
            $("#edit_post").modal('show');
        };

        // update the given post
        ctrl.updatePost = function () {
            $http.patch('/post/' + ctrl.edit_post.id, {
                title: ctrl.edit_post.title,
                description: ctrl.edit_post.description,
                category_id: ctrl.edit_post.category_id
            }).then(function success(e) {
                ctrl.errors = [];
                $("#edit_post").modal('hide');
            }, function error(error) {
                ctrl.recordErrors(error);
            });
        };


        ctrl.deletePost = function (index) {

            var conf = confirm("Do you really want to delete this post?");

            if (conf === true) {
                $http.delete('/post/' + ctrl.posts[index].id)
                    .then(function success(e) {
                        ctrl.posts.splice(index, 1);
                    });
            }
        };

    },
})

