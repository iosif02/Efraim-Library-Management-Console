import MainLayout from "@/views/Layouts/MainLayout.vue";
import UserView from "@/views/Pages/Users/UserView.vue";
import ReadersView from "@/views/Pages/Users/ReadersView.vue";
import ProfileView from "@/views/Pages/Users/ProfileView.vue";
export default
{
    path: "/",
    name: "user",
    redirect: { name: 'users' },
    component: MainLayout,
    children: [
        {
            path: "/users",
            name: "users",
            component: UserView,
        },
        {
            path: "/readers",
            name: "readers",
            component: ReadersView,
        },
        {
            path: "/profile",
            name: "profile",
            component: ProfileView,
        }
    ]
}

