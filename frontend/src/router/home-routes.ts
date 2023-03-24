import BooksHomeView from "@/views/Pages/Books/BooksHomeView.vue";
import MainLayout from "@/views/Layouts/MainLayout.vue"
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
        }
    ]
}