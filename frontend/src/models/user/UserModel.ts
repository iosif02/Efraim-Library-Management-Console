import UserDetailsModel from "./UserDetailsModel";

export default class UserModel {
	id: number = 0;
	name: string = "";
    transaction_count: number = 0;

    user_details: UserDetailsModel = new UserDetailsModel()
}