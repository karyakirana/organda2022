<div>
    <x-molecules.card title="Form Bat">
        <div class="col-8">
            <x-atoms.input.group-horizontal name="id_bat" label="ID" class="mb-5">
                <x-atoms.input.text wire:model.defer="" disabled />
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="nama_customer" label="Customer" class="mb-5">
                <x-atoms.input.text wire:model.defer="nama_cust" data-bs-toggle="modal" data-bs-target="#modalCustomer" readonly />
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="id_mobil" label="Mobil" class="mb-5">
                <x-atoms.input.text wire:model.defer="nopol" data-bs-toggle="modal" data-bs-target="#modalMobil" readonly/>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="no_bat" label="Nomor BAT" class="mb-5">
                <x-atoms.input.text wire:model.defer="no_bat" />
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="tanggal_bat" label="Nomor BAT" class="mb-5">
                <x-atoms.input.singledaterange id="tanggal_bat" />
            </x-atoms.input.group-horizontal>
        </div>
        <x-slot:footer>
            @if($update)
                <x-atoms.button.btn-primary wire:click="update">Update</x-atoms.button.btn-primary>
            @else
                <x-atoms.button.btn-primary wire:click="store">Create</x-atoms.button.btn-primary>
            @endif
        </x-slot:footer>
    </x-molecules.card>

    <x-molecules.modal size="xl" id="modalCustomer" title="Data Customer" wire:ignore.self>
        <div class="d-flex flex-stack mb-5">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search"/>
            </div>
            <!--end::Search-->

        </div>
        <!--end::Wrapper-->
        <x-atoms.table id="datatables" wire:ignore>
            <x-slot:head>
                <x-atoms.table.td>ID</x-atoms.table.td>
                <x-atoms.table.td>Nama</x-atoms.table.td>
                <x-atoms.table.td>Telepon</x-atoms.table.td>
                <x-atoms.table.td>Alamat</x-atoms.table.td>
                <x-atoms.table.td>Status</x-atoms.table.td>
                <x-atoms.table.td></x-atoms.table.td>
            </x-slot:head>
        </x-atoms.table>
    </x-molecules.modal>

    <x-molecules.modal size="xl" id="modalMobil" title="Data Mobil" wire:ignore.self>
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-5">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <input type="text" data-kt-mobil-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search"/>
            </div>
            <!--end::Search-->

        </div>
        <!--end::Wrapper-->
        <x-atoms.table id="datatablesMobil" wire:ignore>
            <x-slot:head>
                <x-atoms.table.td>ID</x-atoms.table.td>
                <x-atoms.table.td>Customer</x-atoms.table.td>
                <x-atoms.table.td>Jenis</x-atoms.table.td>
                <x-atoms.table.td>Nopol</x-atoms.table.td>
                <x-atoms.table.td>Status</x-atoms.table.td>
                <x-atoms.table.td></x-atoms.table.td>
            </x-slot:head>
        </x-atoms.table>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let KTDatatablesCustomer = function () {
                // Shared variables
                let table;
                let dt;

                // Private functions
                let initDatatable = function () {
                    dt = $("#datatables").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        order: [],
                        ajax: {
                            type : 'POST',
                            url: "{{route('customer.datatables')}}",
                        },
                        columns: [
                            { data: 'id_cust' },
                            { data: 'nama_cust' },
                            { data: 'telp_cust' },
                            { data: 'alamat_cust' },
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
                            <button type="button" onclick="setCustomer('`+row.id_cust+`')" class="menu-link px-3" data-kt-customer-table-filter="edit_row">
                                        set
                            </button>
                        `;
                                },
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
                let handleSearchDatatable = function () {
                    const filterSearch = document.querySelector('[data-kt-customer-table-filter="search"]');
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

            let KTDatatablesMobil = function () {
                // Shared variables
                let table;
                let dt;

                // Private functions
                let initDatatable = function () {
                    dt = $("#datatablesMobil").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        order: [],
                        ajax: {
                            type : 'POST',
                            url: "{{route('mobil.datatables')}}",
                        },
                        columns: [
                            { data: 'id_mobil' },
                            { data: 'customer.nama_cust' },
                            { data: 'jenis_mobil' },
                            { data: 'nopol_mobil' },
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
                            <button type="button" onclick="setMobil('`+row.id_mobil+`')" class="menu-link px-3" data-kt-mobil-table-filter="edit_row">
                                        set
                            </button>
                        `;
                                },
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
                let handleSearchDatatable = function () {
                    const filterSearch = document.querySelector('[data-kt-mobil-table-filter="search"]');
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
                KTDatatablesCustomer.init();
                KTDatatablesMobil.init();
            });

            function setCustomer(id)
            {
                Livewire.emit('setCustomer', id)
            }

            function setMobil(id)
            {
                Livewire.emit('setMobil', id)
            }

            let modalCustomer = new bootstrap.Modal(document.getElementById('modalCustomer'))

            window.livewire.on('modalCustomerHide', function () {
                modalCustomer.hide()
            })

            let modalMobil = new bootstrap.Modal(document.getElementById('modalMobil'))

            window.livewire.on('modalMobilHide', function () {
                modalMobil.hide()
            })

            $('#tanggal_bat').on('change', function (e) {
                let date = $(this).data("#tanggal_bat");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
                @this.tanggal_bat = e.target.value;
            })
        </script>
    @endpush

</div>
