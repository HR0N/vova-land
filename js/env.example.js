class Env {
    #sBot_token;
    #sGroup_id;
    #google_sheets_url;
    constructor() {
        this.#sBot_token = "000x01";
        this.#sGroup_id = "000x01";
        this.#google_sheets_url = "000x01";
    }
    get_bot_token(){return this.#sBot_token;}
    get_group_id(){return this.#sGroup_id;}
    get_google_sheets_url(){return this.#google_sheets_url;}
}