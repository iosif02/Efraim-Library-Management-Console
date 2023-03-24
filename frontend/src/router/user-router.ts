import MainLayout from "@/views/Layouts/MainLayout.vue";
import UserView from "@/views/Pages/Users/UserView.vue";
import ReadersView from "@/views/Pages/Users/ReadersView.vue";
import ProfileView from "@/views/Pages/Users/ProfileView.vue";
import CreateReadersView from "@/views/Pages/Users/CreateReadersView.vue";
import UpdateReadersView from "@/views/Pages/Users/UpdateReadersView.vue";

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
            path: "/create-reader",
            name: "createReader",
            component: CreateReadersView,
        },
        {
            path: "/reader/:id",
            name: "editReader",
            component: UpdateReadersView,
            props: true,
        },
        {
            path: "/profile",
            name: "profile",
            component: ProfileView,
        }
    ]
}

