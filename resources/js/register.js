window.Vue = require('vue');

Vue.component('register-form', require('./components/register').default);

const app = new Vue({
    el: '#register-form',
});



