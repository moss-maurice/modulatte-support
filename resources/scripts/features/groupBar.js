jQuery(document).ready(function () {
    jQuery(document)
        .on("click", ".group-bar.select-item", function (event) {
            matchMainSelector();

            return;
        })
        .on("click", ".group-bar.select-all", function (event) {
            matchItemsSelector();

            return;
        })
        .on("click", ".group-bar-controls .btn", function (event) {
            event.preventDefault();

            if (!jQuery(this).hasClass("inactive")) {
                jQuery(this)
                    .closest("form")
                    .append('<input type="hidden" name="tab" value="' + jQuery(this).attr("rel-tab") + '" />');

                jQuery(this)
                    .closest("form")
                    .append('<input type="hidden" name="method" value="' + jQuery(this).val() + '" />');

                jQuery(this).closest("form").submit();
            }

            return;
        });

    function matchMainSelector() {
        var selectAll = true;

        jQuery(document)
            .find("input.group-bar")
            .filter(".select-item")
            .each(function (index) {
                if (jQuery(this).is(":checked") !== true) {
                    selectAll = false;
                }
            });

        jQuery(document).find("input.group-bar").filter(".select-all").prop("checked", selectAll);

        matchBarStatus();

        return;
    }

    function matchItemsSelector() {
        jQuery(document)
            .find("input.group-bar")
            .filter(".select-item")
            .each(function (index) {
                jQuery(this).prop(
                    "checked",
                    jQuery(document).find("input.group-bar").filter(".select-all").is(":checked")
                );
            });

        matchBarStatus();

        return;
    }

    function matchBarStatus() {
        var show = false;

        jQuery(document)
            .find("input.group-bar")
            .each(function (index) {
                if (jQuery(this).is(":checked") === true) {
                    show = true;
                }
            });

        if (show) {
            showBar();

            return;
        }

        hideBar();

        return;
    }

    function showBar() {
        jQuery(document)
            .find(".group-bar-controls")
            .find(".btn.inactive")
            .each(function (index) {
                jQuery(this).removeClass("inactive").addClass("active");
            });

        return;
    }

    function hideBar() {
        jQuery(document)
            .find(".group-bar-controls")
            .find(".btn.active")
            .each(function (index) {
                jQuery(this).removeClass("active").addClass("inactive");
            });

        return;
    }
});
