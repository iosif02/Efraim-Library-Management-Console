import MainLayout from "@/views/Layouts/MainLayout.vue";
import BookDetailsViewVue from "@/views/Pages/Books/BookDetailsView.vue";
import CreateAndUpdateBookViewVue from "@/views/Pages/Books/CreateAndUpdateBookView.vue";
import BorrowBookViewVue from "@/views/Pages/Books/BorrowBookView.vue";
import CategoryBooksViewVue from "@/views/Pages/Books/CategoryBooksView.vue";
import AuthorBooksViewVue from "@/views/Pages/Books/AuthorBooksView.vue";
import PublisherBooksViewVue from "@/views/Pages/Books/PublisherBooksView.vue";
import userBorrowedBooksViewVue from "@/views/Pages/Books/UserBorrowedBooksView.vue";
import BooksViewVue from "@/views/Pages/Books/BooksView.vue";

export default
{
    path: "/",
    name: "book",
    component: MainLayout,
    redirect: { name: 'books' },
    children: [
        {
            path: "/books",
            name: "books",
            component: BooksViewVue
        },
        {
            path: "/create-book",
            name: "createBook",
            component: CreateAndUpdateBookViewVue
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
            component: CreateAndUpdateBookViewVue,   
            props: true,
        },
        {
            path: "/borrow-book/:id",
            name: "borrowBook",
            component: BorrowBookViewVue,
            props: true,
        },
        {
            path: "/category-book/:id",
            name: "categoryBooks",
            component: CategoryBooksViewVue,
            props: true,
        },
        {
            path: "/author-book/:id",
            name: "authorBooks",
            component: AuthorBooksViewVue,
            props: true,
        },
        {
            path: "/publisher-book/:id",
            name: "publisherBooks",
            component: PublisherBooksViewVue,
            props: true,
        },
        {
            path: "/user-borrowed-book/:id",
            name: "userBorrowedBook",
            component: userBorrowedBooksViewVue,
            props: true,
        },
    ]
};