<template>
    <div>
        <div>
            <router-link to="/">Home</router-link>
            <router-link to="/about">About</router-link>
            <router-link to="/dashboard">Dashboard</router-link>
        </div>

        <div>
            <div v-if="authenticated && user">
                <p>Hello, {{user.name}}</p>
                <a href="#" @click="logout">Выход</a>
            </div>
            <div v-if="!authenticated">
                <router-link to="/login">Вход</router-link>
            </div>
        </div>

        <div style="margin-top: 2em;">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                authenticated: auth.check(),
                user: auth.user
            };
        },
        mounted() {
            Event.$on('userLoggedIn', ()=>{
                this.authenticated = true;
                this.user = auth.user;
            });
            Event.$on('userLoggedOut', ()=>{
                this.authenticated = false;
                this.user = null
                ;
            });
        },
        methods:{
            logout(){
                auth.logout();
                this.$router.push('/');

            },
        }

    }
</script>

<style scoped>

</style>