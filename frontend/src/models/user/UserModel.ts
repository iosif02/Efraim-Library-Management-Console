import UserDetailsModel from "@/models/user/UserDetailsModel";

export default class UserModel {
	id: number = 0;
	name: string = "";
    email: string = "";
    is_admin: boolean = false;
    first_name: string = "";
    last_name: string = "";
    transaction_count: number = 0;

    user_details: UserDetailsModel = new UserDetailsModel()
}