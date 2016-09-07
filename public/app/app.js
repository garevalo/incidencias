var app = angular.module('apprayuela', [],function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}).constant('API_URL', 'http://incidencias.app/');

app.directive('calendar', function () {
    return {
        require: 'ngModel',
        link: function (scope, el, attr, ngModel) {
            $(el).datepicker({
                dateFormat: 'yy-mm-dd',
                monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
                dayNamesMin: [ "Do", "Lu", "Ma", "Mie", "Jue", "Vie", "Sa" ],
                onSelect: function (dateText) {
                    scope.$apply(function () {
                        ngModel.$setViewValue(dateText);
                    });
                },
                changeMonth: true,
                changeYear:true,
            });
        }
    };
})