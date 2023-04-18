export default class RoleModel {
    id: number = 0;
	name: string = "";
    pivot: Pivot = new Pivot();
}

class Pivot {
    role_id: number = 0;
    user_id: number = 0;
}