window.Vue = require('vue');

Vue.component('words', require('./components/words').default);

const app = new Vue({
    el: '#words',
});



