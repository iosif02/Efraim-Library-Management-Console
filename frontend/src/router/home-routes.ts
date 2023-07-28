import BooksHomeView from "@/views/Pages/Books/BooksHomeView.vue";
import MainLayout from "@/views/Layouts/MainLayout.vue"
import DelayedBooksViewVue from "@/views/Pages/Books/DelayedBooksView.vue";
import PopularBooksViewVue from "@/views/Pages/Books/PopularBooksView.vue";
import CategoriesViewVue from "@/views/Pages/Books/CategoriesView.vue";
export default
{
    path: "/",
    name: "home",
    redirect: { name: 'homepage' },
    component: MainLayout,
    children: [
        {
            path: "/home-page",
            name: "homepage",
            component: BooksHomeView,   
        },
        {
            path: "/delayed-books",
            name: "delayedBooks",
            component: DelayedBooksViewVue
        },
        {
            path: "/popular-books",
            name: "popularBooks",
            component: PopularBooksViewVue
        },
        {
            path: "/categories",
            name: "categories",
            component: CategoriesViewVue
        },
    ]
}