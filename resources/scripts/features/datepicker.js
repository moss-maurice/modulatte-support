jQuery("document").ready(function () {
    var dpOffset = -10;
    var dpformat = "dd-mm-YYYY hh:mm:00";
    var dpdayNames = ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"];
    var dpmonthNames = [
        "Январь",
        "Февраль",
        "Март",
        "Апрель",
        "Май",
        "Июнь",
        "Июль",
        "Август",
        "Сентябрь",
        "Октябрь",
        "Ноябрь",
        "Декабрь",
    ];
    var dpstartDay = 1;
    var DatePickers = document.querySelectorAll("input.DatePicker");
    if (DatePickers) {
        for (var i = 0; i < DatePickers.length; i++) {
            let format = DatePickers[i].getAttribute("data-format");
            new DatePicker(DatePickers[i], {
                yearOffset: dpOffset,
                format: format !== null ? format : dpformat,
                dayNames: dpdayNames,
                monthNames: dpmonthNames,
                startDay: dpstartDay,
            });
        }
    }
});
