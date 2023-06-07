new Vue({
    el: "#app",
    data: {
        create_form: false,

        edit_form: false,
        edit_character: {}

    },
    methods: {
        edit(character){
            this.edit_form = true;
            this.edit_character = character;
            console.log(character)
        }
    }
});
