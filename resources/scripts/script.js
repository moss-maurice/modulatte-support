jQuery("document").ready(function () {
    tinymce.init({
        selector: "textarea.tinyMCE",
    });

    jQuery("form").submit(function () {
        window.documentDirty = false;
    });

    /**
     * Рейтинг (звёзды)
     */
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

    /**
     * Сортировка
     */
    jQuery(document).on("click", "table.table thead tr th.tableHeader .order", function (event) {
        if (jQuery(this).find("i.fa").length) {
            if (jQuery(this).find("i.fa").hasClass("fa-sort")) {
                jQuery(this).find("i.fa").removeClass("fa-sort").addClass("fa-sort-up").addClass("text-success");

                jQuery(this).closest("th").find("input[type=hidden]").val("asc");
            } else if (jQuery(this).find("i.fa").hasClass("fa-sort-up")) {
                jQuery(this).find("i.fa").removeClass("fa-sort-up").addClass("fa-sort-down").addClass("text-success");

                jQuery(this).closest("th").find("input[type=hidden]").val("desc");
            } else if (jQuery(this).find("i.fa").hasClass("fa-sort-down")) {
                jQuery(this).find("i.fa").removeClass("fa-sort-down").addClass("fa-sort").removeClass("text-success");

                jQuery(this).closest("th").find("input[type=hidden]").val("none");
            }

            jQuery(this).closest("form").submit();
        }
    });
});
