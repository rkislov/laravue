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
                                <a v-if="ticket.status === 'Открыта'" href="#" class=""><span class="fa fa-comments" style="color:black"></span></a>


                                <a v-if="ticket.status === 'Открыта'" href="#" class=""><span class="fa fa-eye" style="color:black"></span></a>
                                <a v-if="ticket.status === 'Открыта'"  href="#" class=""><span class="fa fa-check" style="color:green"></span></a>


                            </td>
                        </tr>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tickets: [],

            }
        },

        mounted() {
            this.fetchTickets();
        },
        methods: {
            fetchTickets()
            {
                let user = window.localStorage.getItem('user');
                user = JSON.parse(user);
                axios.get('api/tickets/'+ user.id).then((resp) => {
                    this.tickets = resp.data;
                });

            },

        }
    }
</script>

<style scoped>

</style>