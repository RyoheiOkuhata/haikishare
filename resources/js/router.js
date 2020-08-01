import Vue from 'vue'
import VueRouter from 'vue-router'
import SocialSharing from 'vue-social-sharing'
 

 
Vue.use(VueRouter);
Vue.use(SocialSharing)
 
const router = new VueRouter({
  mode: 'history',
  relative: true,
  routes: [
    //{ path: '/', component: require('./components/Hello.vue').default },
    { path: '/hello/:id', name: 'id',component: require('./components/Hello.vue').default,props: true},
    { path: '/world', component: require('./components/World.vue').default,props: true},
    { path: '/json', component: require('./components/CreateBtn.vue').default,props: true},

  ]
});
 
new Vue({
  router,
}).$mount('#app');