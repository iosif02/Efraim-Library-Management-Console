<script setup lang="ts">
import HistoryBook from '@/views/Components/Books/HistoryBookComponent.vue';
import PopularBooks from '@/views/Components/Books/PopularBooksComponent.vue'
import Pagination from '@/views/Components/Global/PaginationComponent.vue';
import router from '@/router';
import { useBooksStore } from '@/stores/books-store';

const props = defineProps({
  id: String,
  userName: String,
})

if(!props.id || props.id == '0' || !parseInt(props.id))
    router.replace({ name: 'readers' });

const store = useBooksStore();
store.userBorrowedBooks.searchModel.user = parseInt(props.id || '');
store.userHistoryBooks.searchModel.user = parseInt(props.id || '');
store.userBorrowedBooks.searchModel.pagination.page = 1;
store.userHistoryBooks.searchModel.pagination.page = 1;
store.searchUserBorrowedBooks();
store.searchUserHistoryBooks();

</script>

<template>
    <Loading v-if="store.isLoading || store.isLoadingTwo" />

    <GoBack :go-back-text="`${$route.query.userName} (${store.userBorrowedBooks.searchModel.pagination.total})`"/>

    <SearchBar
        :defaultValue="store.userBorrowedBooks.searchModel.title"
        @valueChanged="(value: string) => (
            store.userBorrowedBooks.searchModel.title = value, 
            store.userBorrowedBooks.searchModel.pagination.page = 1, 
            store.searchUserBorrowedBooks(),
            store.userHistoryBooks.searchModel.title = value, 
            store.userHistoryBooks.searchModel.pagination.page = 1, 
            store.searchUserHistoryBooks()
        )"
        placeholder='Search book...'
    />
    <div v-if="store.userBorrowedBooks.searchModel.pagination.total || store.userHistoryBooks.searchModel.pagination.total">
        <Bounded v-if="store.userBorrowedBooks.searchModel.pagination.total" text='Active'/>
        <PopularBooks v-if="store.userBorrowedBooks.searchModel.pagination.total" :books="store.userBorrowedBooks.data" />
        
        <Pagination
            :current-page="store.userBorrowedBooks.searchModel.pagination.page"
            :last-page="store.userBorrowedBooks.searchModel.pagination.last_page"
            @change-page="(page: number) => (store.userBorrowedBooks.searchModel.pagination.page = page, store.searchUserBorrowedBooks())"
        />

        <Bounded v-if="store.userHistoryBooks.searchModel.pagination.total" text='History'/>
        <HistoryBook v-if="store.userHistoryBooks.searchModel.pagination.total" :transactions="store.userHistoryBooks.data" />

        <Pagination
            :current-page="store.userHistoryBooks.searchModel.pagination.page"
            :last-page="store.userHistoryBooks.searchModel.pagination.last_page"
            @change-page="(page: number) => (store.userHistoryBooks.searchModel.pagination.page = page, store.searchUserHistoryBooks())"
        />
    </div>
    
    <div class="no-found" v-else-if="!store.isLoading && !store.isLoadingTwo"> No result found </div>
    
</template>