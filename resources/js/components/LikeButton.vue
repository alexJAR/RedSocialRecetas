<template>
    <div>
        <span class="like-btn" v-on:click="likeReceta" :class="{'like-active' : isActive }"></span>
        <p>Personas que les ha gustado la receta: {{cantidadLikes}}</p>
    </div>
</template>

<script>
    export default {
        props: ['recetaId', 'like', 'likes'],
        data: function() {
            return {
                isActive: this.like,
                totalLikes: this.likes
            }
        },
        methods: {
            likeReceta() {
                axios.post('/recetas/' + this.recetaId)
                    .then(respuesta => {
                        if(respuesta.data.attached.length > 0) {
                            this.$data.totalLikes++;
                        } else {
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive
                    })
                    .catch(error => {
                        if(error.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
            cantidadLikes: function() {
                return this.totalLikes
            }
        }   
    }
</script>