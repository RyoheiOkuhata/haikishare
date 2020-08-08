<template>
<div>
<li class="p-form--item__file">
<span class="p-form-text">画像</span>
 <input type="file" placeholder="画像" class="c-file" name="img" value="" ref="file" @change="onFileChange($event)">

<!--
プレビュー用
 -->
    <img
    :src="imageData"
    v-if="imageData"
    class="img-preview"
    >
 <!--
DBにすでにデータが入っていた時、表示
 -->
<img
    :src="buyerSrc"
    v-if="Isimg"
    class="img-preview"
    :class ="edit"
    v-bind:class="{displayblock:edit}"
    >
</li>



  <button v-on:click="resetFile" type="button"
  class="btn p-btn--close"
    name="img-reset">
   画像を編集する
  </button>
 </div>
</template>

<script>
export default {
   props: {
     Idbuyer: {
        type: Number,
        default:0,
      },
     Isimg:{//プロフィール画像の有無
         type: Boolean,
        default:false,
      },
        },
  data() {
    return {
      imageData:'',
      buyerid : this.Idbuyer,
      buyerSrc:'https://haiki.s3-us-west-1.amazonaws.com/'+ this.Idbuyer,
      edit:true,//エディットモード
      }
    },

methods: {
//------------------------------
//画像リセット
//------------------------------
resetFile: function () {
    const input = this.$refs.file;
    input.type = 'text';//inputのtypeをtextにして一旦空にする
    input.type = 'file';//元に戻す
    this.imageData = '';//dataを空にする
    this.buyerSrc = '';
    this.edit = false;
    },

 //------------------------------
////画像を読み込み
//------------------------------
  onFileChange: function (e) {
          const files = e.target.files;
          if(files.length > 0) {//画像が選択されたかをチェック
          var self = this;
          var file = files[0];
          var reader = new FileReader();//文字ファイルを読み込む
          reader.onload = function(e) {
              self.imageData = e.target.result;
          };
          reader.readAsDataURL(file);//画像を読み込み
            }
        },
     },
}
</script>
<style>
</style>



