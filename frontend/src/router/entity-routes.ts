import MainLayout from "@/views/Layouts/MainLayout.vue";
import EntitiesView from "@/views/Pages/Entities/EntitiesView.vue";
import AuthorsView from "@/views/Pages/Entities/AuthorsView.vue";
import CreateAuthorView from "@/views/Pages/Entities/CreateAuthorView.vue";
import UpdateAuthorView from "@/views/Pages/Entities/UpdateAuthorView.vue";
import CategoriesView from "@/views/Pages/Entities/CategoriesView.vue";
import CreateCategoryView from "@/views/Pages/Entities/CreateCategoryView.vue";
import UpdateCategoryView from "@/views/Pages/Entities/UpdateCategoryView.vue";
import PublishersView from "@/views/Pages/Entities/PublishersView.vue";
import CreatePublisherView from "@/views/Pages/Entities/CreatePublisherView.vue";
import UpdatePublisherView from  "@/views/Pages/Entities/UpdatePublisherView.vue";
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
            component: EntitiesView,
        },
        {
            path: "/author",
            name: "author",
            component: AuthorsView,
        },
        {
            path: "/create-author",
            name: "createAuthor",
            component: CreateAuthorView,
        },
        {
            path: "/author/:id",
            name: "editAuthor",
            component: UpdateAuthorView,
            props: true,
        },
        {
            path: "/category",
            name: "category",
            component: CategoriesView,
        },
        {
            path: "/create-category",
            name: "createCategory",
            component: CreateCategoryView,
        },
        {
            path: "/category/:id",
            name: "editCategory",
            component: UpdateCategoryView,
            props: true,
        },
        {
            path: "/publisher",
            name: "publisher",
            component: PublishersView,
        },
        {
            path: "/create-publisher",
            name: "createPublisher",
            component: CreatePublisherView,
        },
        {
            path: "/publisher/:id",
            name: "editPublisher",
            component: UpdatePublisherView, 
            props: true,
        }
    ]
};