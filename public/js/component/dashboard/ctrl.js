angular.module('app').component('dashboard', {
    bindings: {
        data: '='
    },
    templateUrl: 'js/component/dashboard/view.html',
    controller: function ($http) {
        var ctrl = this;

        ctrl.get_counters = function () {
            $http.get('/counters')
                .then(function success(e) {
                    debugger
                    ctrl.counters = e.data;
                });
        };


        ctrl.get_counters();

    },
})

