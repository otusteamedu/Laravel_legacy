<template>
    <div>
        <div class='list'>
            <div v-for='element in elements' :key='element.id'>
                <router-link class='list-item__link' :to='element.link'>
                    <div class='list-item__id'>{{ element.id }}</div>
                    <div v-for='(property, index) in element' :key='index'>
                        <div 
                            v-if='index != "id" && index != "link" && property !== undefined'
                            class='list-item__cell'
                        >
                            {{ property }}
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'vue_table',
    props: [
        'elements'
    ]
}
</script>