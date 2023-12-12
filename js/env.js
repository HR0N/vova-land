class Env {
    #sBot_token;
    #sGroup_id;
    #google_sheets_url;
    constructor() {
        this.#sBot_token = "000x01";
        this.#sGroup_id = "000x01";
        this.#google_sheets_url = "https://script.google.com/macros/s/AKfycbwYKFwbPvTS5DuC4VQBLXuGEHkr8I4rjOqNyQlfiO74oNI3Jvj2wV9ukd7b769Jnn1N/exec";
    }
    get_bot_token(){return this.#sBot_token;}
    get_group_id(){return this.#sGroup_id;}
    get_google_sheets_url(){return this.#google_sheets_url;}
}