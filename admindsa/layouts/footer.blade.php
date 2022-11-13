<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweet-alert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/evo-calendar/js/evo-calendar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
        // $('.datepicker').datepicker()
        //     .on(picker_event, function(e) {
        //         // `e` here contains the extra attributes
        //     });
        loadTransactionTable();
        loadEmployeeTable();
        loadBookingTable();
        loadProfitWithoutDate();
        loadRateTable();
        $('#date').evoCalendar({
            sidebarToggler: true,
            sidebarDisplayDefault: true,
            eventListToggler: false,
            eventDisplayDefault: false,

            format: 'yyyy-mm-dd',
            onSelectDate: function(e) {
                console.log(e);
            }
        });

        $('#date').on('selectDate', function(a, b) {
            var selectedDate = a.target.evoCalendar.$active.date;
            var url = "{{ route('admin.profit.selectDate', ':date') }}";
            $.ajax({
                type: 'GET',
                url: url.replace(':date', selectedDate),
                success: function(res, textStatus, xhr) {
                    console.log(res);
                    $('#selectedScheduleDate').text(selectedDate);
                    loadProfitTable(selectedDate);
                    $('[data-date="dateInput"]').val(selectedDate);
                    $('#btnTotalFee').attr('disabled', false);
                    loadFeeTable(selectedDate);
                },
                error: function(res, xhr) {
                    var table = $('#profitTable').DataTable();
                    table.destroy();
                    // var totalFee = $('#totalFee').DataTable();
                    // totalFee.destroy();
                    loadProfitTable(selectedDate);
                    $('#totalFee tbody').empty();
                    $('#profitDetail').modal('show');
                    $('#btnTotalFee').attr('disabled', true);
                    $('#selectedDate').text(selectedDate);
                    $('#insertProfit').submit(function(e) {
                        e.preventDefault();
                        var formData = new FormData(this);
                        var insertUrl =
                            "{{ route('admin.profit.insertProfit', ':id') }}";
                        $.ajax({
                            url: insertUrl.replace(':id', selectedDate),
                            type: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content'),
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $('#profitDetail').modal('hide');
                                var oTable = $('#profitTable')
                                    .dataTable();
                                oTable.fnDraw(false);
                                swal("Success",
                                    "Keuntungan berhasil didata",
                                    "success");
                                // $("#btn-save").html('Submit');
                                // $("#btn-save"). attr("disabled", false);
                            },
                            error: function(data) {
                                swal("Gagal",
                                    "Data dengan waktu siang atau pagi telah ada, mohon cek terlebih dahulu",
                                    "error");
                            }
                        });
                    })
                }
            });
            // console.log(a.target.evoCalendar.$active.date);
        })
    });
    $('#passwordSwitch').change(function() {
        if ($(this).is(':checked')) {
            $('#email').prop('readonly', false);
            $('#password').prop('readonly', false);
            $('#name').prop('readonly', false);
        } else {
            $('#email').prop('readonly', true);
            $('#password').prop('readonly', true);
            $('#name').prop('readonly', true);
        }

    })
    $('#countFee').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.employee.setTotalFee') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                var oTable = $('#totalFee').dataTable();
                oTable.fnDraw(false);
                // swal("Success", "Jadwal berhasil dimasukkan", "success");
                // $("#btn-save").html('Submit');
                // $("#btn-save"). attr("disabled", false);
            },
            error: function(data) {
                console.log(data);
            }
        })
    })
    $('#insertScheduleForm').submit(
        function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.employee.insert') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#insertSchedule').modal('hide');
                    var oTable = $('#totalFee').dataTable();
                    oTable.fnDraw(false);
                    swal("Success", "Jadwal berhasil dimasukkan", "success");
                    // $("#btn-save").html('Submit');
                    // $("#btn-save"). attr("disabled", false);
                },
                error: function(data) {
                    swal("Gagal", "Data telah ada", "error");
                }
            })
        }
    )

    function loadFeeTable(date) {
        var url = "{{ route('admin.profit.fee', ':date') }}";
        $('#totalFee').DataTable({
            "bInfo": false,
            searching: false,
            paging: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: url.replace(':date', date),
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'total_fee',
                    name: 'total_fee'
                },
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(1).footer()).html('Rp. ' + total);
            },

        })
    }

    function loadProfitTable(date) {
        $('#user_id').select2({
            dropdownParent: $('#insertSchedule'),
            ajax: {
                url: "{{ route('admin.employee.getAll') }}",
                dataType: 'json',
                delay: 250,
                type: 'GET',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
        })
        var url = "{{ route('admin.profit.showTable', ':date') }}";
        $('#profitTable').DataTable({
            "bInfo": false,
            searching: false,
            paging: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: url.replace(':date', date),
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'daytime',
                    name: 'daytime'
                },
                {
                    data: 'for_cash',
                    name: 'for_cash'
                },
                {
                    data: 'for_employee',
                    name: 'for_employee'
                },
                {
                    data: 'for_owner',
                    name: 'for_owner'
                },
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(1).footer()).html('Rp. ' + total);
            },

        })
    }

    function loadEmployeeTable() {
        $('#EmployeeTable').DataTable({
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: "{{ route('admin.employee.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'pass',
                    name: 'pass'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        }, )
    }

    function deleteEmployee(id) {
            var url = "{{ route('admin.employee.delete', ':id') }}";
            var finalUrl = url.replace(':id', id);
            // console.log(finalUrl);
            $.ajax({
                url: finalUrl,
                success: function(res) {
                    var oTable = $('#EmployeeTable').dataTable();
                    oTable.fnDraw(false);
                    swal("Success", "Karyawan berhasil dihapus", "success");
                }
            });
    }

    $('#detailPencucian').on('select2:select', function(e) {
        var url = "{{ route('admin.price.detail', ':id') }}";
        var finalUrl = url.replace(':id', e.params.data.id);
        $.ajax({
            url: finalUrl,
            success: function(res) {
                $('#total').val(res.price);
            }
        });
    })
    $('#wash_type').on('change', function() {
        var wash_type = $('#wash_type').find(":selected").val();
        var url = "{{ route('admin.detail.pencucian', ':id') }}";
        var finalUrl = url.replace(':id', wash_type);
        if (wash_type == "Karpet") {
            $('#merk_model').attr('disabled', true);
            $('#plate_number').attr('disabled', true);
        } else {
            $('#merk_model').attr('disabled', false);
            $('#plate_number').attr('disabled', false);
        }

        $('#detailPencucian').select2({
            dropdownParent: $('#addTransaction'),
            ajax: {
                url: finalUrl,
                dataType: 'json',
                delay: 250,
                type: 'GET',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
        })
    })

    function loadTransactionTable() {
        var url = '{{ route('admin.transaction') }}';
        $('#transactionTable').DataTable({
            "bInfo": false,
            searching: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: url,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'plate_number',
                    name: 'plate_number'
                },
                {
                    data: 'merk_model',
                    name: 'merk_model'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'wash_type.name',
                    name: 'wash_type.name'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        });

    }

    function loadRateTable() {
        var url = '{{ route('admin.rate.index') }}';
        $('#rateTable').DataTable({
            "bInfo": false,
            searching: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: url,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        });
    }

    function updateRate(id) {
        // console.log(id);
        var url = "{{ route('admin.rate.edit', ':id') }}"
        $('#editTransaction').modal('show');
        $.ajax({
            url: url.replace(':id', id),
            success: function(res) {
                $('#rateName').val(res.name)
                $('#priceBefore').val(res.price)
            }
        });
        $('#rateUpdateForm').submit(function(e) {
            var url = "{{ route('admin.rate.update', ':id') }}"
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: url.replace(':id', id),
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#editTransaction').modal('hide');
                    var oTable = $('#rateTable').dataTable();
                    oTable.fnDraw(false);
                    swal("Success", "Tarif harga berhasil diubah", "success");
                    // $("#btn-save").html('Submit');
                    // $("#btn-save"). attr("disabled", false);
                },
            })
        })
    }

    function loadBookingTable() {
        var url = '{{ route('admin.booking.index') }}';
        $('#bookingTable').DataTable({
            "language": {
                "emptyTable": "Reservasi kosong",
            },
            "bInfo": false,
            searching: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: url,
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'plate_number',
                    name: 'plate_number'
                },
                {
                    data: 'merk_model',
                    name: 'merk_model'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'wash_type.name',
                    name: 'wash_type.name'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        });
    }
    $('#addEmployeeForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.employee.insertEmployee') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#addEmployee').modal('hide');
                var oTable = $('#EmployeeTable').dataTable();
                oTable.fnDraw(false);
                swal("Success", "Karyawan berhasil didata", "success");
                // $("#btn-save").html('Submit');
                // $("#btn-save"). attr("disabled", false);
            },
            error: function(data) {
                console.log(data);
            }
        })
    })
    $('#transactionInsertForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#loading').addClass("spinner-border text-light spinner-border-sm");
        $.ajax({
            url: "{{ route('admin.transaction.insert') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            contentType: false,
            processData: false,
            success: (data, http) => {
                $('#addTransaction').modal('hide');
                var oTable = $('#transactionTable').dataTable();
                oTable.fnDraw(false);
                swal("Success", "Transaksi berhasil didata", "success");
                // $("#btn-save").html('Submit');
                // $("#btn-save"). attr("disabled", false);
            },
            error: function(data) {
                $('#showAlert').append(` <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  Nama yang dimasukkan telah mencuci sebanyak 5 kali, bonus pencucian berlaku
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`)
                let timerId = setInterval(1000);

                // after 5 seconds stop
                setTimeout(() => {
                    clearInterval(timerId);
                    $('#addTransaction').modal('hide');
                    var oTable = $('#transactionTable').dataTable();
                    oTable.fnDraw(false);
                    swal("Success", "Transaksi berhasil didata", "success");
                }, 1000);
                // console.log(data);
            }
        })
    })

    function loadProfitWithoutDate() {
        var table = $('#profitTable').DataTable({
            "bInfo": false,
            searching: false,
            paging: false,
            destroy: true,
            "ordering": false,
            serverSide: true,
            ajax: "{{ route('admin.rekap.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'daytime',
                    name: 'daytime'
                },
                {
                    data: 'for_cash',
                    name: 'for_cash'
                },
                {
                    data: 'for_employee',
                    name: 'for_employee'
                },
                {
                    data: 'for_owner',
                    name: 'for_owner'
                },
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(1)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(1, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(1).footer()).html('Rp. ' + total);
            },

        })

        $('#sortData').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.rekap.getBetweenDate') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var table = $('#profitTable').DataTable();
                    table.destroy();
                    $('#profitTable').DataTable({
                        "bInfo": false,
                        searching: false,
                        paging: false,
                        destroy: true,
                        "ordering": false,
                        serverSide: true,
                        data: data,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'total',
                                name: 'total'
                            },
                            {
                                data: 'date',
                                name: 'date'
                            },
                            {
                                data: 'daytime',
                                name: 'daytime'
                            },
                            {
                                data: 'for_cash',
                                name: 'for_cash'
                            },
                            {
                                data: 'for_employee',
                                name: 'for_employee'
                            },
                            {
                                data: 'for_owner',
                                name: 'for_owner'
                            },
                        ],
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();

                            // Remove the formatting to get integer data for summation
                            var intVal = function(i) {
                                return typeof i === 'string' ? i.replace(/[\$,]/g,
                                    '') * 1 : typeof i === 'number' ? i : 0;
                            };

                            // Total over all pages
                            total = api
                                .column(1)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(1, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(1).footer()).html('Rp. ' + total);
                        },

                    })
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    }
</script>
<script>
    let cardColor, headingColor, axisColor, shadeColor, borderColor;
    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    // Total Revenue Report Chart - Bar Chart
    // --------------------------------------------------------------------
    const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
        totalRevenueChartOptions = {
            series: [{
                    name: '2021',
                    data: [18, 7, 15, 29, 18, 12, 9]
                },
                {
                    name: '2020',
                    data: [-13, -18, -9, -14, -5, -17, -15]
                }
            ],
            chart: {
                height: 300,
                stacked: true,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '33%',
                    borderRadius: 12,
                    startingShape: 'rounded',
                    endingShape: 'rounded'
                }
            },
            colors: [config.colors.primary, config.colors.info],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 6,
                lineCap: 'round',
                colors: [cardColor]
            },
            legend: {
                show: true,
                horizontalAlign: 'left',
                position: 'top',
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3
                },
                labels: {
                    colors: axisColor
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            grid: {
                borderColor: borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                },
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                }
            },
            responsive: [{
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '32%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1580,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '35%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '42%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '48%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '40%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: '48%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '30%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 840,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '35%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '28%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '32%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '37%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 480,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '45%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 420,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '52%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: '60%'
                            }
                        }
                    }
                }
            ],
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
        const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
        totalRevenueChart.render();
    }

    // Growth Chart - Radial Bar Chart
    // --------------------------------------------------------------------
    const growthChartEl = document.querySelector('#growthChart'),
        growthChartOptions = {
            series: [78],
            labels: ['Growth'],
            chart: {
                height: 240,
                type: 'radialBar'
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '55%'
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: '100%'
                    },
                    dataLabels: {
                        name: {
                            offsetY: 15,
                            color: headingColor,
                            fontSize: '15px',
                            fontWeight: '600',
                            fontFamily: 'Public Sans'
                        },
                        value: {
                            offsetY: -25,
                            color: headingColor,
                            fontSize: '22px',
                            fontWeight: '500',
                            fontFamily: 'Public Sans'
                        }
                    }
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                }
            },
            stroke: {
                dashArray: 5
            },
            grid: {
                padding: {
                    top: -35,
                    bottom: -10
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof growthChartEl !== undefined && growthChartEl !== null) {
        const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
        growthChart.render();
    }

    // Profit Report Line Chart
    // --------------------------------------------------------------------
    const profileReportChartEl = document.querySelector('#profileReportChart'),
        profileReportChartConfig = {
            chart: {
                height: 90,
                // width: 175,
                type: 'line',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    top: 10,
                    left: 5,
                    blur: 3,
                    color: config.colors.warning,
                    opacity: 0.15
                },
                sparkline: {
                    enabled: true
                }
            },
            grid: {
                show: false,
                padding: {
                    right: 8
                }
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            series: [{
                    name: '2022',
                    data: [110, 270, 145, 245, 205, 285]
                },

            ],
            xaxis: {
                show: false,
                lines: {
                    show: false
                },
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                show: false
            }
        };
    if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
        const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
        profileReportChart.render();
    }

    // Order Statistics Chart
    // --------------------------------------------------------------------
    const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
        orderChartConfig = {
            chart: {
                height: 165,
                width: 130,
                type: 'donut'
            },
            labels: ['Electronic', 'Sports', 'Decor', 'Fashion'],
            series: [85, 15, 50, 50],
            colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
            stroke: {
                width: 5,
                colors: cardColor
            },
            dataLabels: {
                enabled: false,
                formatter: function(val, opt) {
                    return parseInt(val) + '%';
                }
            },
            legend: {
                show: false
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            value: {
                                fontSize: '1.5rem',
                                fontFamily: 'Public Sans',
                                color: headingColor,
                                offsetY: -15,
                                formatter: function(val) {
                                    return parseInt(val) + '%';
                                }
                            },
                            name: {
                                offsetY: 20,
                                fontFamily: 'Public Sans'
                            },
                            total: {
                                show: true,
                                fontSize: '0.8125rem',
                                color: axisColor,
                                label: 'Weekly',
                                formatter: function(w) {
                                    return '38%';
                                }
                            }
                        }
                    }
                }
            }
        };
    if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
        const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
        statisticsChart.render();
    }

    // Income Chart - Area chart
    // --------------------------------------------------------------------
    const incomeChartEl = document.querySelector('#incomeChart'),
        incomeChartConfig = {
            series: [{
                data: [24, 21, 30, 22, 42, 26, 35, 29]
            }],
            chart: {
                height: 215,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            legend: {
                show: false
            },
            markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 0,
                    dataPointIndex: 7,
                    strokeColor: config.colors.primary,
                    strokeWidth: 2,
                    size: 6,
                    radius: 8
                }],
                hover: {
                    size: 7
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: shadeColor,
                    shadeIntensity: 0.6,
                    opacityFrom: 0.5,
                    opacityTo: 0.25,
                    stops: [0, 95, 100]
                }
            },
            grid: {
                borderColor: borderColor,
                strokeDashArray: 3,
                padding: {
                    top: -20,
                    bottom: -8,
                    left: -10,
                    right: 8
                }
            },
            xaxis: {
                categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                },
                min: 10,
                max: 50,
                tickAmount: 4
            }
        };
    if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
        const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
        incomeChart.render();
    }

    // Expenses Mini Chart - Radial Chart
    // --------------------------------------------------------------------
    const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
        weeklyExpensesConfig = {
            series: [65],
            chart: {
                width: 60,
                height: 60,
                type: 'radialBar'
            },
            plotOptions: {
                radialBar: {
                    startAngle: 0,
                    endAngle: 360,
                    strokeWidth: '8',
                    hollow: {
                        margin: 2,
                        size: '45%'
                    },
                    track: {
                        strokeWidth: '50%',
                        background: borderColor
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            show: false
                        },
                        value: {
                            formatter: function(val) {
                                return '$' + parseInt(val);
                            },
                            offsetY: 5,
                            color: '#697a8d',
                            fontSize: '13px',
                            show: true
                        }
                    }
                }
            },
            fill: {
                type: 'solid',
                colors: config.colors.primary
            },
            stroke: {
                lineCap: 'round'
            },
            grid: {
                padding: {
                    top: -10,
                    bottom: -15,
                    left: -10,
                    right: -10
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
        const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
        weeklyExpenses.render();
    }
</script>
