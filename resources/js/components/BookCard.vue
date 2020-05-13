<template>
    <div class="card">
        <div class="card-header">
            <img :alt="book.title" :src="book.img?book.img:'/img/book.png'" class="card-img-top">
        </div>
        <div class="card-body">
            <div class="card-title">
                <a :href="link" v-if="link">{{book.title}}</a>
                <template v-else>{{book.title}}</template>
            </div>
            <p class="card-text">{{book.annotation}}</p>
            <button class="btn btn-outline-dark"><i class="fa fa-download"></i> Download</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            book: {type: Object, required: true},
            link: {type: String, default: null},
        },
    }
</script>
