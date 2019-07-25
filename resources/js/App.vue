<template>
    <v-app>
        <v-toolbar></v-toolbar>
        <v-content>
            <router-view></router-view>
        </v-content>
        <v-footer></v-footer>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('App mounted.')
        },
        methods: {
        }
    }
</script>
