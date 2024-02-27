jQuery(document).ready(function () {
    jQuery(document).on("click", "button#filter-run", function (event) {
        event.preventDefault();

        jQuery(this).closest("form").find("input[name=actor]").val("filter");

        jQuery(this).closest("form").submit();
    });
});
