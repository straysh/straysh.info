var require = {
    urlArgs: "bust=" + (new Date()).getTime(),
    baseUrl: "/js_develop",
    paths: {
        /* packages */
        jquery: "../packages/jquery/dist/jquery",

        /* libs */
        backbone: "libs/backbone/backbone",
        underscore: "libs/underscore/underscore",
        UI: "libs/UI"
    },
    shim: {
        backbone: {
            deps: ["underscore"],
            exports: "Backbone"
        }
    }
};