import MainLayout from "@/views/Layouts/MainLayout.vue";
import BooksHomeViewVue from "@/views/Pages/Books/BooksHomeView.vue";
import DelayedBooksViewVue from "@/views/Pages/Books/DelayedBooksView.vue";
import PopularBooksViewVue from "@/views/Pages/Books/PopularBooksView.vue";
import CategoriesViewVue from "@/views/Pages/Books/CategoriesView.vue";
import CreateBookViewVue from "@/views/Pages/Books/CreateBookView.vue";
import BookDetailsViewVue from "@/views/Pages/Books/BookDetailsView.vue";
import UpdateBookViewVue from "@/views/Pages/Books/UpdateBookView.vue";
import BorrowBookViewVue from "@/views/Pages/Books/BorrowBookView.vue";

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
            component: BooksHomeViewVue
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
        {
            path: "/create-book",
            name: "createBook",
            component: CreateBookViewVue
        },
        {
            path: "/books/:id",
            name: "bookDetails",
            component: BookDetailsViewVue,
            props: true
        },
        {
            path: "/edit/:id",
            name: "editBook",
            component: UpdateBookViewVue,   
            props: true,
        },
        {
            path: "/borrow-book/:id",
            name: "borrowBook",
            component: BorrowBookViewVue,
            props: true,
        },
    ]
};