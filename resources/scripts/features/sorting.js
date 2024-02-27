jQuery(document).ready(function () {
    jQuery(document).on("click", "table.table thead tr th.tableHeader .order", function (event) {
        event.preventDefault();

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

            jQuery(this).closest("form").find("input[name=actor]").val("order");

            jQuery(this).closest("form").submit();
        }
    });
});
