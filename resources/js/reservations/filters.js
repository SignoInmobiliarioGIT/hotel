$(function () {
    $('.my-daterangepicker').daterangepicker({
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
        opens: 'left',
        minYear: 2015,
        maxYear: parseInt(moment().format('YYYY'), 10)
    }, function (start, end, label) {
        // var years = moment().diff(start, 'years');
        // alert("You are " + years + " years old!");
        // console.log(start + '-' + end);
    });
});
