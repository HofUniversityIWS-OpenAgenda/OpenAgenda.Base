module.exports = function (config) {
    config.set({

        basePath: '../',

        files: [

            'required_components/jquery/jquery-1.11.2.min.js',
            'required_components/angular/angular.js',
            'required_components/angular-route/angular-route.js',
            'required_components/angular-mocks/angular-mocks.js',
            'required_components/angular-animate/angular-animate.js',
            'required_components/angular-resource/angular-resource.js',
            'required_components/angular-sanitize/angular-sanitize.js',
            'required_components/ui-bootstrap/ui-bootstrap-tpls-0.12.0.min.js',
            'required_components/fullcalendar/moment.js',
            'required_components/fullcalendar/fullcalendar.min.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/lib/ng-breadcrumbs.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/lib/ng-calendar.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/lib/xeditable.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/lib/angular-file-upload.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/lib/autocomplete.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/app.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/controller.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Common/commonFactories.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Common/commonDirectives.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Common/commonServices.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Common/data.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Common/http.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/TopBar/topBarController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Dashboard/dashboardController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Menu/menuController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Meeting/meetingIndexController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Meeting/meetingEditController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Meeting/meetingExecuteController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Task/taskIndexController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Task/taskEditController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Setting/userProfileController.js',
            '../Packages/Application/OpenAgenda.Application/Resources/Public/Scripts/Features/Setting/userSettingController.js',
            'test/unit/**/*.js'
        ],

        autoWatch: true,

        frameworks: ['jasmine'],

        browsers: ['Chrome'],

        reporters: ['spec'],
        
        plugins: [
            'karma-chrome-launcher',
            'karma-jasmine'
        ],

        junitReporter: {
            outputFile: 'test_out/unit.xml',
            suite: 'unit'
        }

    });
};