$(function () {
    $('.my-daterangepicker').daterangepicker({
        // showDropdowns: true,
        // ranges: {
        //     'Hoy': [moment(), moment()],
        //     'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //     'Esta semana': [moment().startOf('week'), moment().endOf('week')],
        //     'Última semana': [moment().subtract(6, 'days'), moment()],
        //     'Últimas 2 semanas': [moment().subtract(13, 'days'), moment()],
        //     'Este mes': [moment().startOf('month'), moment().endOf('month')],
        //     'Mes anterior': [moment().subtract(1, 'month').startOf('month'),
        //         moment().subtract(1, 'month').endOf('month')
        //     ]
        // },
        autoUpdateInput: true,
        applyClass: 'btn-sm btn-primary',
        cancelClass: 'btn-sm btn-default',
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
        // singleDatePicker: true,
        // showDropdowns: true,
        opens: 'left',
        minYear: 2015,
        maxYear: parseInt(moment().format('YYYY'), 10)
    }, function (start, end, label) {
        var years = moment().diff(start, 'years');
        // alert("You are " + years + " years old!");
        console.log(start + '-' + end);
    });
});
