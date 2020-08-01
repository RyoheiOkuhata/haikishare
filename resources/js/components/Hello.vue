
<template>
<div>

  <h1>購入さきのデータ</h1>

  <input v-model="keyword" placeholder="Search...">

    <section class="l-inner-wrapper__s">
    <div class="l-inner">
      <div class="c-inner--body">
        <ul class="c-card--list__flex">

<li class="p-card--gallery">
  <a :href="`/hello/${product.id}`"
    >


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

  props: {
    id: [   
      {
      type: String,
      required: true
    },
  ]
  },
      
  data() { 
      return {
        product:'', 
         id: '',

      };
    },
    mounted() {
 var url = `ajax/hello/${this .id}`;
        axios.get(url)
        .then(response =>{
        console.log(response.data);
          this.product = response.data; 
  })
      .catch(error => console.log(error))
 },



  }
</script>







