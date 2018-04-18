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

                    <div class="comment">
                        <!--@foreach($ticket->comments as $comment)-->
                        <!--<div class="panel panel-@if($ticket->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">-->
                        <!--<div class="panel panel-heading">-->
                            <!--{{$comment->user->name}}-->
                            <!--<span class="pull-right">{{$comment->created_at->format('d.m.Y')}} г.</span>-->
                        <!--</div>-->
                        <!--<div class="panel panel-body">-->
                            <!--{{$comment->comment}}-->
                        <!--</div>-->
                    <!--</div>-->

                    <!--@endforeach-->
                </div>
                <!--@if ($ticket->status !== 'Закрыта')-->
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
                  this.comments = this.ticket.comments;
               });
           },

           createNewComment(){
               let data = {
                   comment: this.comment,
                   ticket_id: this.$route.params.id,
                   user_id: this.user.id,
               };
               axios.post('api/comment'.data)
                   .then(({data})=>{
                       this.comment = '';

                       this.fetchComments();

                   })
                   .catch(({response})=>{
                       alert(response.data.message);
                   })
           },
            fetchComments(){

            }

        }
    }
</script>

<style scoped>

</style>