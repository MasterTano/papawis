<template>
    <v-container fluid>
        <h1> {{title}} </h1>
        <v-btn @click="logIn" small primary>Log In with Google</v-btn>
    </v-container>
</template>

<script>
    export default {
        name: 'AuthLogin',
        data() {
            return {
                title: 'Login'
            }
        },
        methods: {
            async logIn(provider){
                let res = await $_axios.post('/oauth/google');
                console.log(res.data.url)
                window.open(res.data.url)
            }
        }
    }
</script>
