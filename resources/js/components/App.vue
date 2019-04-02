<template>
    <div class="container">
        <div class="row justify-content-center">
            <button @click="signIn">Sign In with Google</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('App mounted.')
        },
        methods: {
            async signIn(provider){
                let res = await axios.post('/api/oauth/google');
            }
        }
    }
</script>
