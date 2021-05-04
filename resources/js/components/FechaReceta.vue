<template>
    <span v-text="formatearFecha"></span>
    <!-- es lo mismo que
    <span> {{formatearFecha}}</span>-->
</template>

<script>
    export default {
     props: ['fecha'],
     computed: {
         formatearFecha(){
             return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
         }
     },
    }
</script>
