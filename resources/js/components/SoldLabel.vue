<template>
  <div 
  class="p-label-content" 
  :class="label"
  >
  <span class="p-label">SOLD</span> 
</div>
</template>
<script>

export default {
mounted() {
 },
  props: {
      initialIsBuyerOrderedBy: {
         type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        idsBuyerOrderedBy: this.initialIsBuyerOrderedBy,
      }
    },
 computed: {
      label() {
        return this.idsBuyerOrderedBy
          ? 'displayblock'
          : 'displaynone'
      },
        }
}
</script>
<style>
</style>
