$(document).ready(function () {
    $('.summernote').summernote({
        height: 200,
        tabsize: 2,
        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48', '64', '72', '100'],
        toolbar: [
            ['cleaner', ['cleaner']], // The Button
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['fontsize', ['fontsize']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['media', 'link', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        cleaner: {
            action: 'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline: '<br>', // Summernote's default is to use '<p><br></p>'
            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
            icon: '<i class="note-icon">[Limpar]</i>',
            keepHtml: false, // Remove all Html formats
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>', '<i>', '<a>'], // If keepHtml is true, remove all tags except these
            keepClasses: false, // Remove Classes
            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
            badAttributes: ['style', 'start'], // Remove attributes from remaining tags
            limitChars: false, // 0/false|# 0/false disables option
            limitDisplay: 'both', // text|html|both
            limitStop: false // true/false
        }
    });

/*
    $('.summernote').summernote({
        height: 300,
        tabsize: 2,
        lang: 'pt-BR',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    */

    /*
    // Caso o summernote seja carregado numa div é necessário atribuir o código ao valor do campo original
    $("form").submit(function( event ) {
        text = $('.summernote').summernote('code');
        $('#text-post').attr('value',text);
    });
    var markupStr = $('#text-post').attr('value');
    $('.summernote').summernote('code', markupStr);
    */
});
