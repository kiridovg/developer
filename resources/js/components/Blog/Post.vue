<template>
    <div class="card mx-auto mt-3 mb-3 d-flex flex-column" style="width: 18rem;">
        <img src="https://99px.ru/sstorage/53/2014/05/tmb_102421_3124.jpg" class="card-img-top mt-3" alt="">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{name}}</h5>
            <p class="card-text">{{description}}</p>
            <p class="card-text"></p>
            <a href="#" class="btn btn-primary mt-auto">Переход куда-нибудь</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                default: "NULL"
            },
            description: {
                type: String,
                default: "NULL"
            },
            image: {
                type: String,
                default: "NULL"
            }
        }
    }
</script>

<style scoped>

</style>
