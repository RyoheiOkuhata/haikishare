require('./router');
require('./jquery');
require('axios');


window.Vue = require('vue');
window.$ = require('jquery')



Vue.component('buy-btn', require('./components/BuyBtn.vue').default);
Vue.component('sold-label', require('./components/SoldLabel.vue').default);
Vue.component('product-img', require('./components/ProductImg.vue').default);
Vue.component('profile-img', require('./components/ProfileImg.vue').default);
Vue.component('profile-buyer-img', require('./components/ProfileBuyerImg.vue').default);
Vue.component('sns-share', require('./components/SnsShare.vue').default);





Vue.component('create-btn', require('./components/CreateBtn.vue').default);
Vue.component('hello', require('./components/Hello.vue').default);
Vue.component('world', require('./components/World.vue').default);
Vue.component('list-item', require('./components/ListItem.vue').default);





const app = new Vue({
    el: '#app',
    router: "router"
});




