import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home.vue')
    },
    {
        path: '/about',
        component: require('./views/About.vue')
    },
    {
        path: '/login',
        component: require('./views/Login.vue')
    },
    {
        path: '/my_tickets',
        component: require('./views/Dashboard.vue'),
        meta:{requireAuth: true}
    },

    {
        path: '/new_ticket',
        component: require('./views/tickets/add_ticket.vue'),
        meta:{requireAuth: true}
    },
    {
        path: '/ticket',
        name: 'ticket',
        component: require('./views/tickets/show.vue'),
        meta:{requireAuth: true}
    },
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next)=>{
    if(to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/login',
                query: {redirect: to.fullPath}
            });

            return;
        }
    }
    next();
});
export default router;
