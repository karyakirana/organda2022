<x-metronics>
    @if(session()->has('message'))
        <x-molecules.alert-danger>
            {{session('message')}}
        </x-molecules.alert-danger>
    @endif
    <x-molecules.card title="Data Sopir">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-5">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search"/>
            </div>
            <!--end::Search-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center gap-2 gap-lg-3 justify-content-end" data-kt-docs-table-toolbar="base">

            
            </div>
            <!--end::Toolbar-->

        </div>
        <!--end::Wrapper-->
        <x-atoms.table id="datatables" wire:ignore.self>
            <x-slot:head>
                <x-atoms.table.td>Customer</x-atoms.table.td>
                <x-atoms.table.td>Nama</x-atoms.table.td>
                <x-atoms.table.td>KTP</x-atoms.table.td>
                <x-atoms.table.td>NIK TPS</x-atoms.table.td>
                <x-atoms.table.td>NIK Lamong</x-atoms.table.td>
            </x-slot:head>
        </x-atoms.table>
    </x-molecules.card>

    @push('scripts')
        <script>
            var KTDatatablesServerSide = function () {
                // Shared variables
                var table;
                var dt;

                // Private functions
                var initDatatable = function () {
                    dt = $("#datatables").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        order: [],
                        ajax: {
                            type : 'POST',
                            url: "{{route('report.sopir.datatables')}}",
                        },
                        columns: [
                            { data: 'customer.nama_cust' },
                            { data: 'nama_sopir' },
                            { data: 'ktp_sopir' },
                            { data: null },
                            { data: null },
                        ],
                        columnDefs: [
                            {
                                targets: -2,
                                data: null,
                                orderable: false,
                                className: 'text-center',
                                render: function (data, type, row){
                                    if(row.transaksi_tps != null){
                                        return row.transaksi_tps.nik_tps
                                    }
                                    return ''
                                }
                            },
                            {
                                targets: -1,
                                data: null,
                                orderable: false,
                                className: 'text-center',
                                render: function (data, type, row){
                                    if(row.transaksi_lamong != null){
                                        return row.transaksi_lamong.nik_lamong
                                    }
                                    return ''
                                }
                            },
                        ],
                        // Add data-filter attribute
                        createdRow: function (row, data, dataIndex) {
                            $(row).find('td:eq(4)').attr('data-filter', data.status);
                        }
                    });

                    table = dt.$;

                    // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
                    dt.on('draw', function () {
                        KTMenu.createInstances();
                    });
                }

                // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
                var handleSearchDatatable = function () {
                    const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                    filterSearch.addEventListener('keyup', function (e) {
                        dt.search(e.target.value).draw();
                    });
                }

                // Public methods
                return {
                    init: function () {
                        initDatatable();
                        handleSearchDatatable();
                    }
                }
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTDatatablesServerSide.init();
            });

            function refreshDatatables()
            {
                $('#datatables').DataTable().ajax.reload()
            }

            function destroy(id)
            {
                Swal.fire({
                    title : 'Apakah Anda yakin?',
                    text : 'Data yang dihapus tidak dapat dikembalikan',
                    icon : 'warning',
                    showCancelButton : true,
                    confirmButton : '#3085d6',
                    cancelButton : '#d33',
                    confirmButtonText : 'Yes, delete!'
                }).then((result)=>{
                    if(result.isConfirmed){
                        $.ajax({
                            url : '{{route("mobil.destroy")}}',
                            method : 'delete',
                            data : {
                                id : id
                            },
                            success : function (response){
                                Swal.fire(
                                    'Deleted'
                                )
                                refreshDatatables()
                            }
                        })
                    }
                })
            }

            function blokir(id)
            {
                Swal.fire({
                    title : 'Apakah Anda yakin?',
                    text : 'Data diblokir',
                    icon : 'warning',
                    showCancelButton : true,
                    confirmButton : '#3085d6',
                    cancelButton : '#d33',
                    confirmButtonText : 'Yes, Blokir!'
                }).then((result)=>{
                    if(result.isConfirmed){
                        $.ajax({
                            url : '{{route("mobil.blokir")}}',
                            method : 'post',
                            data : {
                                id : id
                            },
                            success : function (response){
                                Swal.fire(
                                    'Blokir'
                                )
                                refreshDatatables()
                            }
                        })
                    }
                })
            }
        </script>
    @endpush
</x-metronics>
