<template>
    <div class="container">
        <h3>Нажмите на комментарий для редактирования</h3>
        <pagination :data="commentsList" @pagination-change-page="getCommentsList"></pagination>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Автор</th>
                <th scope="col">Таргет</th>
                <th scope="col">Текст</th>
                <th scope="col">Дата</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="comment in commentsList.data">
                <th scope="row">{{ comment.id }}</th>
                <td>{{ comment.author.name }}</td>
                <td>{{ comment.target.name }}</td>
                <td>
                    <router-link :to="{ name: 'profile.comment.edit', params: {id: comment.id}}">
                        {{ comment.text.slice(0, 50) }}...
                    </router-link>
                </td>
                <td>{{ comment.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <pagination :data="commentsList" @pagination-change-page="getCommentsList"></pagination>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.getCommentsList();
        },
        data() {
            return {
                commentsList: {},
            }
        },
        methods: {
            getCommentsList(page = 1) {
                axios.get('/profile/comment/list?page=' + page)
                    .then(response => {
                        console.log(response.data.data[0]);
                        this.commentsList = response.data;
                    });
            }
        }
    }
</script>
