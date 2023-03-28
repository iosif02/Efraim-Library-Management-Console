export default class UserDetailsModel {
    id: number = 0;
	user_id: number = 0
    identity_number: number = 0
    address: string = "";
    phone: number = 0;
    occupation: string = "";
    birth_date: Date = new Date();
    photo_url: string = "";
}