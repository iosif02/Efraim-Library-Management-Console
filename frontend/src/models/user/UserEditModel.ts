export default class UserEditModel {
    id: number = 0;
    email: string = "";
    password: string = "";
    is_admin: boolean = false;
    identity_number: number = 0;
    first_name: string = "";
    last_name: string = "";
    address: string = "";
    phone: number = 0;
    occupation: string = "";
    birth_date: Date = new Date();
    photo_url: string = "";
}