<template>
    <div class="container">
        <h2>Редактирование комментария</h2>
        <div v-if="isUpdateSuccess" class="alert alert-success" role="alert">
            Данные обновлены успешно!
        </div>
        <div v-if="hasUpdateErrors" class="alert alert-danger" role="alert">
            Не удалось обновить данные!
        </div>
        <form>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" class="form-control" id="author" readonly
                       v-model="author">
            </div>
            <div class="form-group">
                <label for="target">Таргет</label>
                <input type="text" class="form-control" id="target" readonly
                       v-model="target">
            </div>
            <div class="form-group">
                <label for="text"></label>
                <textarea class="form-control" id="text" rows="5"
                    v-model="text"
                ></textarea>
                <div v-if="errors && errors.text">
                    <small class="text-danger" v-for="error in errors.text">
                        {{ error }}
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label for="created_at">Дата создания</label>
                <input type="text" class="form-control" id="created_at" readonly
                       v-model="dateCreated">
            </div>
            <div class="form-group">
                <label for="updated_at">Дата последнего обновления</label>
                <input type="text" class="form-control" id="updated_at" readonly
                       v-model="dateUpdated">
            </div>
            <button v-on:click.prevent="sendData" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.commentId = this.$route.params.id;
            this.getCommentData(this.commentId);
        },
        data() {
            return {
                commentId: null,
                author: null,
                target: null,
                text: null,
                dateCreated: null,
                dateUpdated: null,
                isUpdateSuccess: false,
                hasUpdateErrors: false,
                errors: null,
            }
        },
        methods: {
            sendData() {
                this.isUpdateSuccess = false;
                this.hasUpdateErrors = false;
                axios.put('/profile/comment/update/' + this.commentId, {
                    text: this.text
                })
                    .then(response => {
                        this.getCommentData(this.commentId);
                        this.isUpdateSuccess = true;
                        console.log(response);
                    })
                    .catch(errorData => {
                        this.errors = errorData.response.data.errors;
                        this.hasUpdateErrors = true;
                        console.log(errorData);
                    });
            },
            getCommentData(id) {
                axios.get('/profile/comment/get-comment/' + id)
                    .then(response => {
                        this.author = response.data.author.name;
                        this.target = response.data.target.name;
                        this.text = response.data.text;
                        this.dateCreated = response.data.created_at;
                        this.dateUpdated = response.data.updated_at;

                        this.userId = response.data.id;
                        this.name = response.data.name;
                        this.userRoleId = response.data.role_id;
                        this.userEmail = response.data.email;
                        this.errors = null;
                        console.log(response.data);
                    });
            },
            isUserRole(roleId) {
                return roleId === this.userRoleId;
            }
        }
    }
</script>
