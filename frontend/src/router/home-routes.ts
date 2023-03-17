export default
{
    path: "/",
    name: "home",
    redirect: { name: 'homepage' },
    component: () => import("@/views/Layouts/MainLayout.vue"),
    children: [
        {
            path: "/home-page",
            name: "homepage",
            component: () => import("@/views/Pages/Books/BooksHomeView.vue")   
        }
    ]
}