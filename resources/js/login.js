window.Vue = require('vue');

Vue.component('login-form', require('./components/login').default);

const app = new Vue({
    el: '#login-form',
});

