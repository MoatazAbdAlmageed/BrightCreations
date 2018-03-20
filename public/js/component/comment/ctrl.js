angular.module('app').component('comment', {
    bindings: {
        data: '='
    },
    templateUrl: 'js/component/comment/view.html',
    controller: function ($http) {
        var ctrl = this;
        ctrl.comment = [];
        // List comment
        ctrl.loadItems = function () {
            $http.get('/comment')
                .then(function success(e) {
                    ctrl.comments = e.data.comments;

                });
        };
        ctrl.loadItems();

        ctrl.errors = [];

        ctrl.comment = {
            name: '',
            description: ''
        };
        ctrl.initPost = function () {

            ctrl.resetForm();
            $("#add_new_comment").modal('show');
        };
        ctrl.$onInit = function() {

        };
        // Add new Post
        ctrl.addPost = function () {
            $http.comment('/comment', {
                title: ctrl.comment.title,
                description: ctrl.comment.description
            }).then(function success(e) {
                ctrl.resetForm();
                ctrl.comment.push(e.data.comment);
                $("#add_new_comment").modal('hide');

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
            ctrl.comment.name = '';
            ctrl.comment.description = '';
            ctrl.errors = [];
        };


        // initialize update action
        ctrl.initEdit = function (index) {
            ctrl.errors = [];
            ctrl.edit_comment = ctrl.comment[index];
            $("#edit_comment").modal('show');
        };

        // update the given comment
        ctrl.updatePost = function () {
            $http.patch('/comment/' + ctrl.edit_comment.id, {
                title: ctrl.edit_comment.title,
                description: ctrl.edit_comment.description
            }).then(function success(e) {
                ctrl.errors = [];
                $("#edit_comment").modal('hide');
            }, function error(error) {
                ctrl.recordErrors(error);
            });
        };


        ctrl.deletePost = function (index) {

            var conf = confirm("Do you really want to delete this comment?");

            if (conf === true) {
                $http.delete('/comment/' + ctrl.comments[index].id)
                    .then(function success(e) {
                        ctrl.comments.splice(index, 1);
                    });
            }
        };

    },
})

