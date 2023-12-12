class InputGoogleStyle extends Father{
    constructor(el) {
        super(el);
        this.input_name = new InputClass();
        this.input_email = new InputClass();
        this.input_text = new InputClass();

        this.events();
    }

    initInputs(){
        this.input_name.element = this.find('input[name="name"]');
        this.input_email.element = this.find('input[name="email"]');
        this.input_text.element = this.find('input[name="text"]');
    }

    events(){
        this.initInputs();
        this.input_name.element.on('focus', this.input_name.onBlur());
        this.input_email.element.on('focus', this.input_email.onBlur());
        this.input_text.element.on('focus', this.input_text.onBlur());
    }
}


class InputClass {
    constructor() {
        this.element = null;
        this.val = '';
        this.touched = false;
        this.checked = false;
        this.error = false;
        this.errorDescription = false;
    }

    onBlur(){this.touched = true}
}

new InputGoogleStyle('.google-style');