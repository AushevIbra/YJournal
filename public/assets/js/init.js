document.addEventListener("DOMContentLoaded", function () {


    var editor = new CodexEditor({
        /**
         * Create a holder for the Editor and pass its ID
         */
        holderId: 'codex-editor',

        /**
         * Available Tools list.
         * Pass Tool's class or Settings object for each Tool you want to use
         */
        tools: {
            header: {
                class: Header,
                inlineToolbar: true,
                config: {
                    placeholder: 'Введите заголовок'
                }
            },
            checklist: {
                class: Checklist,
                inlineToolbar: true,
            },
            Marker: {
                class: Marker,
                shortcut: 'SHIFT+M',
            },
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,

            },
            list: {
                class: List,
                inlineToolbar: true,
            },
            delimiter: Delimiter,
            quote: Quote,
            image: {
                class: ImageTool,
                config: {
                    url: '/api/upload-image',
                },


            }
        },

        /**
         * Previously saved data that should be rendered
         */
        data: {
            blocks: [
                {
                    "type": "header",
                    data: {
                        text: "",
                        level: 2,
                    }
                }
            ]
        },

    });

    $('[data-id="create-post"]').on('click', function () {
        const tags = $('#select-state').val();
        editor.saver.save().then((savedData) => {
            if (savedData.blocks[0].type !== 'header' || savedData.blocks[0].data.text === '') {
                M.toast({html: 'Заполните заголовок', classes: 'rounded'});
            } else {
                if (savedData.blocks.length == 1) {
                    M.toast({html: 'Ваша запись слишком короткая', classes: 'rounded'});
                    throw "Ваша запись слишком короткая";
                }
                let img = null;
                savedData.blocks.map(item => {
                    if(item.type == 'image') {
                        img = item.data.file.url;
                    }
                })
                let elem_title = document.createElement(`h${savedData.blocks[0].data.level}`);
                elem_title.innerHTML = savedData.blocks[0].data.text;
                let title = elem_title.textContent;

                var data = {data: savedData, title, tags, img};
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/post',
                    data: {data},
                    success: (data) => {
                        location.href = `/post/${data.slug}`;
                    },
                    //dataType: dataType
                });
            }


        });
    })
});

