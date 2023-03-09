import UserDetailsModel from "../user/UserDetailsModel";

export default class TransactionModel {
    id: number = 0;
    borrow_date: string = "";
    is_returned: boolean = false;
    return_date: string = "";

    user_details: UserDetailsModel = new UserDetailsModel()
}