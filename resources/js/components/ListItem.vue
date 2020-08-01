<template>
<div>

  <h1>お笑い芸人リスト</h1>

 <li v-for="(product,key) in products">
    {{product.id}}
    {{product.product_name}}
    {{product.expiration_date}}
  </li>

  

</div>

</template>

<script>
const axios = require('axios');
  export default {
  data() {
      return {
        products:[],
      };
    },
    mounted() {
        var url = 'ajax/json';
        axios.get(url)
        .then(response =>{
        console.log(response.data);
          this.products = response.data; 
  })
      .catch(error => console.log(error))
 },
  getTask() {
         axios.get('/api/tasks/' + this.taskId)
                    .then((res) => {
                        this.task = res.data;
                    });
            },
  }
</script>

