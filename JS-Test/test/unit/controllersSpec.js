'use strict';

/* jasmine specs for controllers go here */
describe('OpenAgenda', function () {
    var scope, $compile, $controller;

    beforeEach(module('OpenAgenda'));

    beforeEach(inject(function (_$rootScope_, _$compile_, _$controller_) {
        scope = _$rootScope_.$new();
        $compile = _$compile_;
        $controller = _$controller_;
    }));

    describe('First simple test', function () {

        it('should be true', function () {
            expect(true).toBe(true);
        });
    });
    describe('App loaded', function () {
        it('should be true', function () {
            var dashboardCtrl;
            expect(dashboardCtrl).toBeUndefined();
            dashboardCtrl = $controller('DashboardCtrl', {$scope: scope});

            expect(dashboardCtrl).toBeDefined();
        });
    });


});
/*
 describe('uiCalendar', function () {
 scope = _$rootScope_.$new();
 $controller = _$controller_;


 });*/
