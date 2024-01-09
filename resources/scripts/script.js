jQuery("document").ready(function () {
    tinymce.init({
        selector: "textarea#tinyMCE",
    });

    jQuery("form").submit(function () {
        window.documentDirty = false;
    });
});
