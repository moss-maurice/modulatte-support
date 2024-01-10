jQuery("document").ready(function () {
    tinymce.init({
        selector: "textarea#tinyMCE",
    });

    jQuery("form").submit(function () {
        window.documentDirty = false;
    });

    jQuery("i.star").on("click", function () {
        let starWrapper = jQuery(".starWrapper");
        let starEmpty = "fa-star-o";
        let starFilled = "fa-star";
        let stars = Number(
            jQuery(this)
                .attr("id")
                .replace(/[^0-9]/g, "")
        );

        jQuery(starWrapper)
            .find("i")
            .each(function (index, item) {
                jQuery(item).removeClass(starEmpty, starFilled);
                if (index + 1 <= stars) {
                    jQuery(item).addClass(starFilled);
                } else {
                    jQuery(item).addClass(starEmpty);
                }
            });

        jQuery(starWrapper).find("input").val(stars);
    });
});
