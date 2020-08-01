<template>
  <div>
 <!-- 
このユーザーが購入していてこの商品が購入されていたら
 -->
    <button 
    class="c-btn p-btn--purchase "
    v-if="isOrderedBy && idsBuyerOrderedBy"
    >キャンセルする
    </button>
 <!-- 
このユーザーが購入していなくてこの商品が購入されていたら
 -->
    <p
    class="c-btn p-btn--purchase"
    v-else-if="isOrderedBy && !idsBuyerOrderedBy"
    >売り切れです
    </p>
 <!-- 
誰も購入していなかったら
 -->
    <button v-else
    class="c-btn p-btn--purchase"
    >購入ページに進む
    </button>

  </div>
</template>
<script>
  export default {
mounted() {
 },
    props: {
      initialIsBuyerOrderedBy: {
        //ログインしているバイヤーがその商品は購入済みかの確認
        type: Boolean,
        default: false,
      },
     initialIsOrderedBy: {
        //この商品は購入されているかの確認
         type: Boolean,
        default: false,
      },
    },
    data() {
      return {//propsの値受け取る

        isOrderedBy: this.initialIsOrderedBy,
        idsBuyerOrderedBy: this.initialIsBuyerOrderedBy,
      }
    },
  }

</script>










<style>



</style>