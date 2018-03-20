angular.module('app').component('dashboard', {
    bindings: {
        data: '='
    },
    templateUrl: 'js/component/dashboard/view.html',
    controller: function ($http) {
        var ctrl = this;

        ctrl.loadPosts = function () {
            $http.get('/post')
                .then(function success(e) {
                    ctrl.posts = e.data.posts;
                    ctrl.categories = [1,2,3];
                    ctrl.comments = [1,2,3,4,5,6,9,8,4];
                });
        };
        ctrl.loadPosts();
    },
})

