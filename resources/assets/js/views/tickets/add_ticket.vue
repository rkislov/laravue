<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Новая служеная записка</div>

                <div class="panel-body">


                    <div class="form-horizontal" >
                    <form action="#" @submit.prevent="createNewTicket()">

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Название</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="" v-model="title">


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Категория</label>
                            <div class="col-md-6">
                                <select id="category" type="category" class="form-control" name="category"  style="height: 30px;" v-model="category">
                                    <option value="">Выберите категорию</option>

                                   <option v-for="category, index in categories" v-bind:value="category.id">{{category.name}}</option>

                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="priority" class="col-md-4 control-label">Приоритет</label>
                            <div class="col-md-6">
                                <select id="priority" type="" class="form-control" name="priority" style="height: 30px;" v-model="priority">
                                    <option value="">Выберите приоритет</option>
                                    <option value="low">Низкий</option>
                                    <option value="medium">Средний</option>
                                    <option value="high">Высокий</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-md-4 control-label" >Сообщение</label>
                            <div class="col-md-6">
                                <textarea rows="10" id="message" class="form-control" name="message" v-model="message"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Создать
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                categories:[],

                    title: '',
                    category: '',
                    priority: '',
                    message: '',
                    user_id:'',
                authenticated: auth.check(),
                user: auth.user,

            };
        },
        mounted(){
            axios.get('api/categories')
                .then((resp) => {
                this.categories = resp.data;
            })
                .catch((resp) =>{
                    console.log(resp);
                    alert("Не могу загрузить список категорий")
                });
            this.user = auth.user;

        },
        methods:{
            createNewTicket(){
                let data = {
                    title: this.title,
                    category: this.category,
                    priority: this.priority,
                    message: this.message,
                    user_id: this.user.id,
                };
                axios.post('/api/new_ticket_store', data)
                    .then(({data})=>{
                        this.title = '';
                        this.category = '';
                        this.priority = '';
                        this.message = '';

                        this.$router.push('/my_tickets');

                    })
                    .catch(({response})=>{
                        alert(response.data.message);
                    })
            }
        }
    }
</script>

<style scoped>

</style>