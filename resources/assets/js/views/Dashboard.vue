<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket">Документы</i>
                </div>
                <div  class="panel-body">

                    <h2 v-if='tickets.length === 0' class="text-center">Все документы исполненны</h2>

                    <table v-if='tickets.length !== 0' class="table">
                        <thead>
                        <tr>
                            <th>Категория</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Обновленна</th>
                            <th style="text-align: center;">Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="ticket, index in tickets">
                            <td>
                                    {{ticket.category.name}}
                            </td>
                            <td>
                                <router-link :to="{name: 'ticket', params: {id: ticket.id}}">
                                    #{{ticket.ticket_id}} - {{ticket.title}}
                                </router-link>
                            </td>
                            <td>

                                <span v-if="ticket.status === 'Открыта'" class="label label-success">{{ticket.status}}</span>

                                <span v-if="ticket.status !== 'Открыта'" class="label label-danger">{{ticket.status}}</span>

                            </td>
                            <td>
                                {{ticket.updated_at}}
                            </td>
                            <td style="text-align: center;">
                                <router-link :to="{name: 'ticket', params: {id: ticket.id}}" v-if="ticket.status === 'Открыта'" class=""><span class="fa fa-eye" style="color:darkcyan"></span></router-link>

                                <a v-if="ticket.status === 'Открыта'"  href="#" class="" @click.prevent="closeTicket(ticket.id)"><span class="fa fa-check" style="color:green"></span></a>


                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <!--<paginate-->
                            <!--:page-count="pageCount"-->
                            <!--:click-handler="fetch"-->
                            <!--:prev-text="'Prev'"-->
                            <!--:next-text="'Next'"-->
                            <!--:container-class="'pagination'">-->
                    <!--</paginate>-->

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

                authenticated: auth.check(),
                user: auth.user,
                tickets: [],
            }
        },

        mounted() {
            this.fetchTickets();
        },
        methods: {
            fetchTickets()
            {

                 let iuser = window.localStorage.getItem('user');
                 iuser = JSON.parse(iuser);
                axios.get('api/tickets/'+ iuser.id).then((resp) => {
                    this.tickets = resp.data;
                })
                    .catch(({response})=>{
                        alert(response.data.message);
                    });

            },
            closeTicket(id)
            {

                axios.put('api/closeticket/'+id).then((resp)=>{
                    this.fetchTickets();

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