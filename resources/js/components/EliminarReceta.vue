<template>
        <input 
        type="submit" 
        class="btn btn-danger w-100 d-block mb-2" 
        value="Eliminar ×"
        v-on:click="eliminarReceta"
        >

</template>

<script>
    export default{
        props: ['recetaId'],
        methods: {
            eliminarReceta(){
                    this.$swal({
                        title: '¿Estas seguro?',
                        text: "No se podra revertir esta acción",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                            const params = {
                                id: this.recetaId
                            }
                            //Enviar la petición al servidor
                            axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                                .then(respuesta =>{
                                   this.$swal(
                                        'Eliminado',
                                        'La receta fue eliminada',
                                        'success'
                                    )
                                    //Eliminar del DOM
                                    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode); 
                                })
                                .catch(error => {
                                    console.log(error)
                                })

                          /*  this.$swal(
                                'Eliminado',
                                'La receta fue eliminada',
                                'success'
                            )*/
                        }
                    })
            }
        }
    }
</script>
