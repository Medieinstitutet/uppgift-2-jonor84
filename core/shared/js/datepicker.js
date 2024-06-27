$(document).ready(function() {
    $('#date-time-picker').datetimepicker({
        locale: 'sv',
        format: 'YYYY-MM-DD HH:mm',
        calendarWeeks: true,
        allowMultidate: true,
        sideBySide: true,
        inline: true,
        todayBtn: false,
        showToday:false,
        todayHighlight: false,
        useCurrent: false,
        icons: {
            time: 'fa fa-clock',
        },
    });

    let dp = $('.datepicker');
    if (dp.length > 0 && !dp.is(':visible')) {
        dp.show();
    }
});
