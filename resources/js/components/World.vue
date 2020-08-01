<template>
    <div>
        <p>
            <router-link to='/json'>World</router-link>
        </p>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>

p {
    color: #333;
}

 a {
         color: #333;   
    }
    
    
</style>