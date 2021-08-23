<template>
    <div>
        <div style="display:flex; flex-wrap: wrap;">
            <post
                v-for="book in books.data" :key="book.id"
                :name="book.name"
                :description="book.description"
                :image="book.image"/>
        </div>
        <pagination :align="align" :data="books" @pagination-change-page="loadPosts"></pagination>
    </div>
</template>

<script>
    import axios from 'axios';
    import Post from "../components/Blog/Post";
    export default {
        components: {
            Post
        },
        data: () => ({
            align: 'center',
            books: {}
        }),
        mounted() {
            this.loadPosts();
        },
        methods: {
            loadPosts(page = 1) {
                axios.get('/api/books?page=' + page)
                .then(res => {
                    this.books = res.data;
                })
            }
        }
    }
</script>

<style scoped>
    .uk-card {
        width: 40%;
        margin-right: 20px;
        margin-bottom: 20px;
    }

    .uk-card:last-child {
        margin-right: 0;
    }
</style>
