<template>
  <div>
    <ShareNetwork
        network="twitter"
        :url="url"
        :title="productInfo"
        :hashtags="hashtags"
      >
      <i class="fab fah fa-lg fa-twitter"></i>
      <span>ツイート
      </span>
    </ShareNetwork>
  </div>
</template>
<script>
export default {
    props: {
      id: {
        type: Number,
        default: false,
      },
      name: {
        type: String,
        default: false,
      },

    },
  data () {
    return {
      productInfo: 'フードシェアサービスHaiki：'+ '商品名：'+  this.name,
      url: 'http://localhost:8000/products/'+ this.id,
      title: '',
      hashtags: 'haiki,foodshare,service',
    }
  }
}
</script>