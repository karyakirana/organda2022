<x-metronics>
    <x-molecules.card title="Data Bat">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-5">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search"/>
            </div>
            <!--end::Search-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center gap-2 gap-lg-3 justify-content-end" data-kt-docs-table-toolbar="base">
                <!--begin::Add customer-->
                <a href="{{route('bat.form')}}" class="btn btn-primary" title="add BAT">
                    Add BAT
                </a>
                <!--end::Add customer-->

                <!--begin::Add customer-->
                <a href="{{route('bat.index.blokir')}}" class="btn btn-primary" title="add BAT">
                    Data Blokir
                </a>
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->

        </div>
        <!--end::Wrapper-->
        <x-atoms.table id="datatables" wire:ignore>
            <x-slot:head>
                <x-atoms.table.td>ID</x-atoms.table.td>
                <x-atoms.table.td>Customer</x-atoms.table.td>
                <x-atoms.table.td>Nopol</x-atoms.table.td>
                <x-atoms.table.td>Nomor BAT</x-atoms.table.td>
                <x-atoms.table.td>Tanggal</x-atoms.table.td>
                <x-atoms.table.td>Status</x-atoms.table.td>
                <x-atoms.table.td></x-atoms.table.td>
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
                            url: "{{route('bat.datatables')}}",
                        },
                        columns: [
                            { data: 'id_bat' },
                            { data: 'customer.nama_cust' },
                            { data: 'mobil.nopol_mobil' },
                            { data: 'no_bat' },
                            { data: 'tanggal_bat' },
                            { data: 'status' },
                            { data: null },
                        ],
                        columnDefs: [
                            {
                                targets: -1,
                                data: null,
                                orderable: false,
                                className: 'text-end',
                                render: function (data, type, row) {
                                    return `
                            <a href="#" class="btn btn-light-primary btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/transaksi/bat/form/`+row.id_bat+`" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" onclick="blokir('`+row.id_bat+`')" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        Blokir
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" onclick="destroy('`+row.id_bat+`')" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                                },
                            },
                            {
                                targets: 4,
                                render: $.fn.dataTable.render.moment('DD MMM YYYY')
                            }
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

            function blokir(id)
            {
                Swal.fire({
                    title : 'Apakah Anda yakin?',
                    text : 'Data blokir',
                    icon : 'warning',
                    showCancelButton : true,
                    confirmButton : '#3085d6',
                    cancelButton : '#d33',
                    confirmButtonText : 'Yes, Blokir!'
                }).then((result)=>{
                    if(result.isConfirmed){
                        $.ajax({
                            url : '{{route("bat.blokir")}}',
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
                            url : '{{route("bat.destroy")}}',
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
        </script>
    @endpush
</x-metronics>
