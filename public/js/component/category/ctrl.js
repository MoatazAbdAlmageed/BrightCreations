angular.module('app').component('category', {
    bindings: {
        data: '='
    },
    templateUrl: 'js/component/category/view.html',
    controller: function ($http) {
        var ctrl = this;
        ctrl.category = [];
        // List category
        ctrl.loadItems = function () {
            $http.get('/category')
                .then(function success(e) {
                    ctrl.categories = e.data.categories;

                });
        };
        ctrl.loadItems();

        ctrl.errors = [];

        ctrl.category = {
            name: '',
            description: ''
        };
        ctrl.initCategory = function () {

            ctrl.resetForm();
            $("#add_new_category").modal('show');
        };
        ctrl.$onInit = function() {

        };
        // Add new Category
        ctrl.addCategory = function () {
            $http.post('/category', {
                title: ctrl.category.title,
                description: ctrl.category.description
            }).then(function success(e) {
                ctrl.resetForm();
                ctrl.categories.push(e.data.category);
                $("#add_new_category").modal('hide');

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
            ctrl.category.name = '';
            ctrl.category.description = '';
            ctrl.errors = [];
        };


        // initialize update action
        ctrl.initEdit = function (index) {

            ctrl.errors = [];
            ctrl.edit_category = angular.copy(ctrl.categories[index]);
            $("#edit_category").modal('show');
        };

        // update the given category
        ctrl.updateCategory = function () {
            $http.patch('/category/' + ctrl.edit_category.id, {
                title: ctrl.edit_category.title,
                description: ctrl.edit_category.description
            }).then(function success(e) {
                ctrl.errors = [];
                $("#edit_category").modal('hide');
            }, function error(error) {
                ctrl.recordErrors(error);
            });
        };


        ctrl.deleteCategory = function (index) {

            var conf = confirm("Do you really want to delete this category?");

            if (conf === true) {
                $http.delete('/category/' + ctrl.categories[index].id)
                    .then(function success(e) {
                        ctrl.categories.splice(index, 1);
                    });
            }
        };

    },
})

