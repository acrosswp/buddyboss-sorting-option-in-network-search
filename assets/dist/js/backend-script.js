/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
jQuery( document ).ready(function($) {
    
    jQuery( "#buddyboss-sorting-main" ).sortable({
        update: function( event, ui ) {
            console.log( event );
            console.log( ui );
        }
    });
});
/******/ })()
;