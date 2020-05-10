<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="search_input">{{$t('search.input')}}</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control" id="search_input">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="genres">{{$t('search.genre')}}</label>
                    <select class="form-control" id="genres" v-model="currentGenre">
                        <option :value="genre.id" v-for="genre in genres" :key="genre.id">{{genre.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sub_genres">{{$t('search.subGenre')}}</label>
                    <select class="form-control" id="sub_genres">
                        <option :value="subGenre.id" v-for="subGenre in subGenres" :key="subGenre.id">{{subGenre.name}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchBar",
        props: {
            genres: {
                type: Array,
                required: true,
            },
        },
        data() {
            return {
                currentGenre: null,
            }
        },
        computed: {
            subGenres() {
                return (this.currentGenre && this.currentGenre.subGenres) || [];
            },
        },

    }
</script>

<style scoped>

</style>
