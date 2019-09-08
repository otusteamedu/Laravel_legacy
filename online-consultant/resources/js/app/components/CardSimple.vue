<template>
    <section class="card-simple">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ title }}</div>

                        <div class="card-body">
                            {{ content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
	    props: ['title', 'content'],
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>
