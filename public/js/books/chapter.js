new Vue({
    el: "#app",
    data: {
        save: true,
        all_characters: null,
        show_characters: []
    },
    mounted(){
        this.all_info();

        new nicEditor().panelInstance('chapter_text');
        this.save_chapter();
    },
    methods: {
        all_info(){
            let path = $(location).attr('href') ;
            path = "/book/" + path.split('/')[4] + '/links/all_info'

            $.ajax({
                url: path,
                type: "GET",
                data: {

                },
                success: (data)=>{
                    this.all_characters = data.characters;
                    this.find_characters();
                }
            });
        },

        save_chapter(){
            setInterval(()=>{
                this.save = false;

                $.ajax({
                    url: location.href + "/save",
                    type: "POST",
                    data: {
                        text: $("#chapter_text").html(),
                    },
                    success: ()=>{
                        setTimeout(()=>{
                            this.save = true;
                        }, 2000)
                    }
                });


            }, 15000);
        },

        find_characters(){
            let html = $("#chapter_text").html();
            this.show_characters = [];

            this.all_characters.forEach(el => {
                let first_name = el.first_name.toLowerCase();
                let last_name = el.last_name.toLowerCase();


                if( (html.toLowerCase().indexOf(first_name) > -1 || html.toLowerCase().indexOf(last_name) > -1)
                     && this.show_characters.indexOf(el) === -1 ){
                    this.show_characters.push(el);
                }
            })
        },


        //find_characters(characters){
            // let html = $("#chapter_text").html();
            // html = html.replaceAll("<character_mark>", "");
            // html = html.replaceAll("</character_mark>", "");
            // $("#chapter_text").html(html);
            //
            //
            //
            // const el = document.getElementById('chapter_text');
            // const selection = window.getSelection();
            // const range = document.createRange(0, 5);
            // selection.removeAllRanges();
            // range.selectNodeContents(el);
            // range.collapse(false);
            // selection.addRange(range);
            // el.focus();
            //
            //
            //
            //
            // characters.forEach(el => {
            //     let first_name = el.first_name.toLowerCase();
            //     let last_name = el.last_name.toLowerCase();
            //
            //     let index = html.toLowerCase().indexOf(first_name);
            //
            //    if(index > -1){
            //        let adding_html_first = "<character_mark>";
            //        let adding_html_last = "</character_mark>";
            //        html = html.slice(0, index) + adding_html_first + html.slice(index, index + first_name.length) + adding_html_last + html.slice(index + first_name.length);
            //        $("#chapter_text").html(html);
            //    }
            // })
        //}
    }
})
