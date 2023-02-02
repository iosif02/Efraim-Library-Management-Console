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
            component: () => import("@/views/Pages/Books/DelayedBooksView.vue")
        },
        {
            path: "/popular-books",
            name: "popularBooks",
            component: () => import("@/views/Pages/Books/PopularBooksView.vue")
        },
        {
            path: "/categories",
            name: "categories",
            component: () => import("@/views/Pages/Books/CategoriesView.vue")
        }
    ]
};