var quill=new Quill(

"#snow-editor",{
    theme:"snow",
    modules:{
        toolbar:[
            [
                {font:[]},
                {size:[]}
            ],
            ["bold","italic","underline","strike"],
            [
                {color:[]},
                {background:[]}
            ],
            [
                {script:"super"},
                {script:"sub"}
            ],
            [
                {header:[!1,1,2,3,4,5,6]},
                "blockquote","code-block"
            ],
            [
                {list:"ordered"},
                {list:"bullet"},
                {indent:"-1"},
                {indent:"+1"}
            ],
            [
                "direction",
                {align:[]}
            ],
            [
                "link",
                "image",
                "video",
                "formula"
            ],
            ["clean"]
        ]
    }
});

/*
var quill=new Quill("#bubble-editor",{theme:"bubble"});
*/

var form = $('.quill');
form.onsubmit = function () {
    // Populate hidden form on submit
    var textfield = $('#description');
    textfield.val() = JSON.stringify(quill.getContents());

    console.log("Submitted", $(form).serialize(), $(form).serializeArray());

    // No back end to actually submit to!
    alert('Open the console to see the submit data!')
    return false;
};
