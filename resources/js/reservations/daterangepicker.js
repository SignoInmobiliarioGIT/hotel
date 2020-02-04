class DateRangePicker {

    constructor(options) {
        this.tag = options.tag || '#dateRange';
        this.from = options.from || moment(new Date()).format("DD-MM-YYYY")
        this.to = options.to || moment(new Date()).add(1, "day").format("DD-MM-YYYY")
    }


    init() {
        $(this.tag).daterangepicker({
            locale: {
                format: 'DD-MM-YYYY',
                applyLabel: 'Aplicar',
                cancelLabel: 'Limpiar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
                customRangeLabel: 'Seleccionar rango',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                    'Diciembre'
                ],
                firstDay: 1
            },
            "startDate": this.from,
            "endDate": this.to
        }, function (start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' +
                end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ') desde la clase');
        });
    }

    getFrom() {
        return $(this.tag).val().substring(0, 10);
    }
    getTo() {
        return $(this.tag).val().substring(13);
    }
}
