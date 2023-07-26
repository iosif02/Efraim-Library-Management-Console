export default class AuthorModel {
    id: number = 0;
    name: string = "";
    book_count: number = 0;
    pivot: Pivot = new Pivot();
}

class Pivot {
    author_id: number = 0;
    book_id: number = 0;
}