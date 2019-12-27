$(function () {
    $('button').prop('disabled', false);
});

require('./bootstrap');

window.Vue = require('vue');
new Vue({
    el: '#app',
});

