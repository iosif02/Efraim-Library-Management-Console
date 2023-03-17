export default
{
    path: "/",
    name: "user",
    redirect: { name: 'users' },
    component: () => import("@/views/Layouts/MainLayout.vue"),
    children: [
        {
            path: "/users",
            name: "users",
            component: () => import("@/views/Pages/Users/ProfileView.vue")
        },
        {
            path: "/readers",
            name: "readers",
            component: () => import("@/views/Pages/Users/ReadersView.vue")
        },
        {
            path: "/profile",
            name: "profile",
            component: () => import("@/views/Pages/Users/ReadersView.vue")
        }
    ]
}

