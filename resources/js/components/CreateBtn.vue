<template>
<div>

  <h1>購入さきのデータ</h1>

  <input v-model="keyword" placeholder="Search...">

    <section class="l-inner-wrapper__s">
    <div class="l-inner">
      <div class="c-inner--body">
        <ul class="c-card--list__flex">

<li class="p-card--gallery"  v-for="(product,key) in products">

  <a :href="`/hello/${product.id}`"
    >
  <router-link v-bind:to="{name: 'id', params: {id: product.id}}">

   </router-link>


    <div class="p-card--gallery__img">
 <img :src="'/storage/products_images/' + product.img">
  </div>
  <h2 class="p-card--gallery__txt">
   {{product.product_name}}
  </h2> 
  </a>
  <router-link to='/hello'>World</router-link>
  </li>
   </ul>
     </div>
  </div>
  </section>
</div>

</template>

<script>
const axios = require('axios');
  export default {
  data() {
      return {
        products:[],
         users: null,
        keyword: '',
      };
    },
    mounted() {
        var url = '/ajax/json';
        axios.get(url)
        .then(response =>{
        console.log(response.data);
          this.products = response.data; 
  })
      .catch(error => console.log(error))
 },

  }
</script>







