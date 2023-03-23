import MainLayout from "@/views/Layouts/MainLayout.vue";

export default
{
    path: "/",
    name: "entity",
    redirect: { name: 'entities' },
    component: MainLayout,
    children: [
        {
            path: "/entities",
            name: "entities",
            component: () => import("@/views/Pages/Entities/EntitiesView.vue"),
        },
        {
            path: "/author",
            name: "author",
            component: () => import("@/views/Pages/Entities/AuthorsView.vue"),
        },
        {
            path: "/create-author",
            name: "createAuthor",
            component: () => import("@/views/Pages/Entities/CreateAuthorView.vue"),
        },
        {
            path: "/author/:id",
            name: "editAuthor",
            component: () => import("@/views/Pages/Entities/UpdateAuthorView.vue"),
            props: true,
        },
        {
            path: "/category",
            name: "category",
            component: () => import("@/views/Pages/Entities/CategoriesView.vue"),
        },
        {
            path: "/create-category",
            name: "createCategory",
            component: () => import("@/views/Pages/Entities/CreateCategoryView.vue"),
        },
        {
            path: "/category/:id",
            name: "editCategory",
            component: () => import("@/views/Pages/Entities/UpdateCategoryView.vue"),
            props: true,
        },
        {
            path: "/publisher",
            name: "publisher",
            component: () => import("@/views/Pages/Entities/PublishersView.vue"),
        },
        {
            path: "/create-publisher",
            name: "createPublisher",
            component: () => import("@/views/Pages/Entities/CreatePublisherView.vue"),
        },
        {
            path: "/publisher/:id",
            name: "editPublisher",
            component: () => import("@/views/Pages/Entities/UpdatePublisherView.vue"), 
            props: true,
        }
    ]
};