export default
{
    path: "/",
    name: "entity",
    redirect: { name: 'entities' },
    component: () => import("@/views/Layouts/MainLayout.vue"),
    children: [
        {
            path: "/entities",
            name: "entities",
            component: () => import("@/views/Pages/Entities/EntitiesView.vue"),
        },
        {
            path: "/authors",
            name: "authors",
            component: () => import("@/views/Pages/Entities/AuthorsView.vue"),
        }
    ]
};