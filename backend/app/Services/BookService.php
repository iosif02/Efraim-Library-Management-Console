<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Interfaces\IBookService;
use App\Interfaces\IFileService;
use App\Models\Book;
use App\Models\Transactions;
use App\Repositories\IBookRepository;
use App\Repositories\IEntityRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class BookService implements IBookService
{
    private IBookRepository $bookRepository;
    private IEntityRepository $entityRepository;
    private IFileService $fileService;

    public function __construct(IBookRepository $bookRepository, IFileService $fileService, IEntityRepository $entityRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->fileService = $fileService;
        $this->entityRepository = $entityRepository;
    }
    public function GetHomepage(): array
    {
        $filters = ['pagination' => [ 'per_page' => 3, 'page' => 1]];
        $delayedBooks = $this->bookRepository->SearchDelayedBooks($filters);
        $popularBooks = $this->bookRepository->SearchPopularBooks($filters);
        $categories = $this->entityRepository->SearchCategories($filters);

        return [
            "delayedBooks" => $delayedBooks,
            "popularBooks" => $popularBooks,
            "categories" => $categories
        ];
    }

    public function AddBook(array $fields): bool
    {
        if(isset($fields['image']) && $fields['image'] != ''){
            $imageName = $this->fileService->StoreFile($fields['image']);
            $fields['image'] = $imageName;
        }

        return $this->bookRepository->AddBook($fields);
    }

    /**
     * @throws CustomException
     */
    public function UpdateBook(array $fields): bool
    {
        $book = $this->bookRepository->GetBookById($fields['bookId']);
        if(!$book)
            throw new CustomException('Book not found!');

        if(isset($fields['image']) && $fields['image'] != ''){
            $imageName = $this->fileService->StoreFile($fields['image']);
            $fields['image'] = $imageName;
        }

        return $this->bookRepository->UpdateBook($fields);
    }

    /**
     * @throws CustomException
     */
    public function DeleteBook(int $bookId): bool
    {
        $book = $this->bookRepository->GetBookById($bookId);
        if(!$book)
            throw new CustomException('Book not found!');

        return $this->bookRepository->DeleteBook($bookId);
    }

    /**
     * @throws CustomException
     */
    public function GetBookDetailsById(int $bookId): Model
    {
        $book = $this->bookRepository->GetBookDetailsById($bookId);
        if(!$book)
            throw new CustomException('Book not found!');

        return $book;
    }

    public function SearchBooks(array $filters): ?LengthAwarePaginator
    {
        return $this->bookRepository->SearchBooks($filters);
    }

    public function SearchDelayedBooks(array $filters): ?LengthAwarePaginator
    {
        return $this->bookRepository->SearchDelayedBooks($filters);
    }

    public function SearchPopularBooks(array $filters): ?LengthAwarePaginator
    {
        return $this->bookRepository->SearchPopularBooks($filters);
    }

    public function SearchRecommendedBooks(array $filters): ?LengthAwarePaginator
    {
        return $this->bookRepository->SearchRecommendedBooks($filters);
    }

    /**
     * @throws CustomException
     */
    public function BorrowBook(array $fields): Transactions
    {
        $book = $this->bookRepository->CheckIfBookIsAvailable($fields['book_id']);
        if(!$book)
            throw new CustomException('Book is unavailable!');
        $user = $this->bookRepository->CheckIfUserCanBorrowBook($fields['user_id']);
        if(!$user)
            throw new CustomException('The user have 2 borrow book already!');

        $fields['borrow_date'] = Carbon::now('Europe/Bucharest');
        $fields['return_date'] = Carbon::now('Europe/Bucharest')->addWeeks(2);
        $fields['is_returned'] = false;
        $fields['lender_name'] = Auth::user()->fullName;

        return $this->bookRepository->BorrowBook($fields);
    }

    /**
     * @throws CustomException
     */
    public function ReturnBook(int $transactionId): Transactions
    {
        $transaction = $this->bookRepository->GetTransactionById($transactionId);
        if(!$transaction)
            throw new CustomException('Transaction not found!');

        return $this->bookRepository->ReturnBook($transactionId);
    }
}
