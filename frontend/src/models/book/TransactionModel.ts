import UserModel from "@/models/user/UserModel";

export default class TransactionModel {
    id: number = 0;
    borrow_date: string = "";
    is_returned: boolean = false;
    return_date: string = "";
    lender_name: string = "";
    receiver_name: string = "";
    delayed: number = 0;

    user: UserModel = new UserModel()
}