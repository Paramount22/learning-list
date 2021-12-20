require('./bootstrap');

import Vue from 'vue';
import FrontPage from './components/FrontPage';
import FlashMessage from './components/FlashMessage'
const app = new Vue({
    el: '#app',
    components: {FrontPage, FlashMessage}
});
