<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ticket.ticket_id}} - {{ticket.title}}
                </div>

                <div class="panel-body">


                    <div class="ticket-info">
                        <p>{{ticket.message}}</p>
                        <p>Категория: {{category.name}}</p>
                        <p>
                            <span v-if="ticket.status === 'Открыта'" class="label label-success">{{ticket.status}}</span>

                            <span v-if="ticket.status !== 'Открыта'" class="label label-danger">{{ticket.status}}</span>
                        </p>
                        <p>Созданно: {{ ticket.created }}</p>
                    </div>
                    <hr>

                    <div class="comment" v-for="(item, index) in comments" :key="index">
                        <!--<div class="panel panel-success">-->
                        <div  class="panel panel-default">
                            <div class="panel panel-heading">
                                {{item.user.name}}

                                <span class="pull-right">{{item.created_at | formatDate}} г.</span>
                            </div>
                            <div class="panel panel-body">
                                {{item.comment}}
                            </div>




                        </div>
                    </div>

                    <div class="comment-form">
                        <form action="#" class="form" id="comment-form" @submit.prevent="createNewComment()">


                            <div class="form-group">
                                <textarea rows="5" id="comment" class="form-control" name="comment" v-model="comment"></textarea>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Отправить</button>
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
               ticket: [],
               category: [],
               comments:[],
               comment: '',
               ticket_id: this.$route.params.id,

           }
       },

        mounted(){
            this.fetchTicket();
            this.fetchComments();
        },
        methods:{
           fetchTicket(){
               axios.get('api/ticket/'+ this.$route.params.id)
                   .then((resp) => {
                  this.ticket = resp.data;
                  this.category = this.ticket.category;
                 // this.comments = this.ticket.comments;
               });
           },

           createNewComment(){
               let user = window.localStorage.getItem('user');
               user = JSON.parse(user);
               let data = {
                   comment: this.comment,
                   ticket_id: this.ticket_id,
                   user_id: user.id,
               };
               axios.post('api/new_comment', data)
                   .then(({data})=>{
                       this.comment = '';

                       this.fetchComments();

                   })
                   .catch(({response})=>{
                       alert(response.data.message);
                   })
           },
            fetchComments(){
                axios.get('api/comments/'+ this.ticket_id)
                    .then((resp)=>{
                            this.comments = resp.data;
                    })
            }

        }
    }
</script>

<style scoped>

</style>