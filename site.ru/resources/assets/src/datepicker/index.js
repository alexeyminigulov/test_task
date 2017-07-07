module.exports = function () {

    $('.datepicker').pickadate({
        format: 'yyyy-mm-dd',
        selectYears: 15,
        labelMonthNext: 'Следующий месяц',
        labelMonthPrev: 'Предыдущий месяц',
        labelMonthSelect: 'Выбрать месяц',
        labelYearSelect: 'Выбрать год',
        monthsFull: [ 'Январь', 'Феврль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        monthsShort: [ 'Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек' ],
        weekdaysFull:  ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        weekdaysShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        weekdaysLetter: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        today: 'Cегодня',
        clear: 'Очистить',
        close: 'Выход'
    });

    $('.datepicker').pickadate()
        .on("input change", function (e) {
            // let url = window.location.href+ '?date=' + e.target.value;

            // var q = getParameterByName('date');
            // if(q) {
            //     url = window.location.origin+ '?date=' + e.target.value;
            // }
            // window.location.href = url;
            window.location.href = window.location.origin+ '/' + e.target.value;
    });

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

};