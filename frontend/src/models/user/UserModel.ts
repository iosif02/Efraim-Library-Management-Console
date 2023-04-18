import UserDetailsModel from "@/models/user/UserDetailsModel";
import type RoleModel from '@/models/user/RoleModel';

export default class UserModel {
	id: number = 0;
	name: string = "";
    email: string = "";
    first_name: string = "";
    last_name: string = "";
    transaction_count: number = 0;

    roles: RoleModel[] = [];
    user_details: UserDetailsModel = new UserDetailsModel()
}