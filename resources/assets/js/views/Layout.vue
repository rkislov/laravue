<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <router-link class="navbar-brand" to="/">

                    Документооборот
                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto" style="float: left;">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto"  style="float: right;">
                        <!-- Authentication Links -->
                        <li  v-if="!authenticated">
                            <!--<a class="nav-link" href="/login">Вход</a>-->
                            <router-link class="nav-link" to="/login">Вход</router-link>
                        </li>
                        <li  v-if="!authenticated"><a class="nav-link" href="/register">Регистрация</a></li>

                        <!--@if(Auth::user()->is_admin)-->
                        <!--<li><a class="nav-link" href="/admin/tickets"><i class="fa fa-btn fa-newspaper-o"></i> Документы</a></li>-->
                        <!--<li><a class="nav-link" href="/my_tickets"> <i class="fa fa-btn fa-inbox"></i> Мои докумменты</a></li>-->
                        <!--<li><a class="nav-link" href="/new_ticket"><i class="fa fa-btn fa-plus"></i> Создать</a></li>-->
                        <!--<li><a class="nav-link" href="/settings"><i class="fa fa-cog" aria-hidden="true"></i> Настройки</a></li>-->

                        <li v-if="authenticated"><router-link class="nav-link" to="/my_tickets"><i class="fa fa-btn fa-inbox"></i> Мои докумменты</router-link></li>
                        <li v-if="authenticated"><router-link class="nav-link" to="/new_ticket"><i class="fa fa-btn fa-plus"></i> Создать</router-link></li>

                        <li class="nav-item dropdown">
                            <a v-if="authenticated && user" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-btn fa-user-circle-o"></i>
                                {{user.name}}

                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"  @click="logout" href="#">
                                    <i class="fa fa-btn fa-sign-out"></i>
                                    Выход
                                </a>


                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!--<div>-->
            <!--<router-link to="/">Home</router-link>-->
            <!--<router-link to="/about">About</router-link>-->
            <!--<router-link to="/dashboard">Dashboard</router-link>-->
        <!--</div>-->

        <!--<div>-->
            <!--<div v-if="authenticated && user">-->
                <!--<p>Hello, {{user.name}}</p>-->
                <!--<a href="#" @click="logout">Выход</a>-->
            <!--</div>-->
            <!--<div v-if="!authenticated">-->
                <!--<router-link to="/login">Вход</router-link>-->
            <!--</div>-->
        <!--</div>-->

        <div class="py-4">
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