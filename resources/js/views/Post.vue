<template>
    <div>
        <spin v-if="loading"/>
        <div v-else-if="!loading && !not_found">
            <h1>{{ book.name }} <span class="uk-badge">{{ post.image }}</span></h1>
            <p class="uk-text-lead">{{ book.description }}</p>
        </div>
        <div v-if="not_found">
            <a class="uk-alert-close"></a>
            <h3>404 пост не найден</h3>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from "axios";

    export default {
        components: {
            Spin
        },
        data: () => ({
            loading: true,
            book: [],
            not_found: false
        }),
        mounted() {
            this.loadPost(this.$route.params.id);
        },
        methods: {
            loadPost(id) {
                axios.get('/api/books/' + id)
                .then(res => {
                    this.post = res.data;
                    setTimeout(()=> {
                        this.loading = false;
                    }, 500);
                })
                .catch(err => {
                    this.not_found = true;
                })
            }
        }
    }
</script>

<style scoped>

</style>
