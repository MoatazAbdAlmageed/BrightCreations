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
debugger
                });
        };
        ctrl.loadItems();

        ctrl.errors = [];

        ctrl.comment = {
            body: '',

        };
        ctrl.initComment = function () {

            ctrl.resetForm();
            $("#add_new_comment").modal('show');
        };
        ctrl.$onInit = function() {

        };
        // Add new Comment
        ctrl.addComment = function () {
            $http.post('/comment', {
                body: ctrl.comment.body,
                post_id: 2,
                user_id: 1,
            }).then(function success(e) {
                ctrl.resetForm();
                ctrl.comments.push(e.data.comment);
                $("#add_new_comment").modal('hide');
                ctrl.loadItems();
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
            ctrl.comment.body = '';

            ctrl.errors = [];
        };


        // initialize update action
        ctrl.initEdit = function (index) {
            ctrl.errors = [];
            ctrl.edit_comment = angular.copy( ctrl.comments[index]);
            $("#edit_comment").modal('show');
        };

        // update the given comment
        ctrl.updateComment = function () {
            $http.patch('/comment/' + ctrl.edit_comment.id, {
                body: ctrl.edit_comment.body,
                post_id: 2,
                user_id: 1,
            }).then(function success(e) {
                ctrl.loadItems();
                ctrl.errors = [];
                $("#edit_comment").modal('hide');
            }, function error(error) {
                ctrl.recordErrors(error);
            });
        };


        ctrl.deleteComment = function (index) {

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

