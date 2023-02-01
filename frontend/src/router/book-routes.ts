import MainLayout from "@/views/Layouts/MainLayout.vue";

export default
{
    path: "/",
    name: "home",
    component: MainLayout,
    redirect: { name: 'books' },
    children: [
        {
            path: "/books",
            name: "books",
            component: () => import("@/views/Pages/Books/BooksHomeView.vue"),
        },
        {
            path: "/delayed-books",
            name: "delayedBooks",
            components: {
                default: () => import("@/views/Pages/Books/DelayedBooksView.vue"),
                GoBack: () => import("@/components/global/GoBack.vue")
            }
        },
        {
            path: "/popular-books",
            name: "popularBooks",
            components: {
                default: () => import("@/views/Pages/Books/PopularBooksView.vue"),
                GoBack: () => import("@/components/global/GoBack.vue")
            }
        },
        {
            path: "/categories",
            name: "categories",
            components: {
                default: () => import("@/views/Pages/Books/CategoriesView.vue"),
                GoBack: () => import("@/components/global/GoBack.vue")
            }
        }
    ]
};