<div>
    <x-molecules.card title="Form TPS">
        <div class="col-8">
            <x-atoms.input.group-horizontal name="id_transaksitps" label="ID" class="mb-5">
                <x-atoms.input.text wire:model.defer="id_transaksitps" disabled/>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="nama_sopir" label="Sopir" class="mb-5">
                <x-atoms.input.text wire:model.defer="nama_sopir" data-bs-toggle="modal" data-bs-target="#modalSopir" readonly/>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal name="nik_tps" label="NIK" class="mb-5">
                <x-atoms.input.text wire:model.defer="nik_tps" />
            </x-atoms.input.group-horizontal>
        </div>

        <x-slot:footer>
            @if($update)
                <x-atoms.button.btn-primary wire:click="update">Update</x-atoms.button.btn-primary>
            @else
                <x-atoms.button.btn-primary wire:click="store">Store</x-atoms.button.btn-primary>
            @endif
        </x-slot:footer>
    </x-molecules.card>

    <x-molecules.modal size="xl" id="modalSopir" title="Data Sopir" wire:ignore.self>
        <div class="d-flex flex-stack mb-5">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <input type="text" data-kt-sopir-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search"/>
            </div>
            <!--end::Search-->

        </div>
        <!--end::Wrapper-->
        <x-atoms.table id="datatablesSopir" wire:ignore>
            <x-slot:head>
                <x-atoms.table.td>ID</x-atoms.table.td>
                <x-atoms.table.td>Customer</x-atoms.table.td>
                <x-atoms.table.td>Nama</x-atoms.table.td>
                <x-atoms.table.td>SIM</x-atoms.table.td>
                <x-atoms.table.td>Status</x-atoms.table.td>
                <x-atoms.table.td></x-atoms.table.td>
            </x-slot:head>
        </x-atoms.table>
    </x-molecules.modal>

    @push('scripts')
        <script>

            let KTDatatablesSopir = function () {
                // Shared variables
                let table;
                let dt;

                // Private functions
                let initDatatable = function () {
                    dt = $("#datatablesSopir").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        order: [],
                        ajax: {
                            type : 'POST',
                            url: "{{route('sopir.datatables')}}",
                        },
                        columns: [
                            { data: 'id_sopir' },
                            { data: 'customer.nama_cust' },
                            { data: 'nama_sopir' },
                            { data: 'sim_sopir' },
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
                            <button type="button" onclick="setSopir('`+row.id_sopir+`')" class="menu-link px-3" data-kt-customer-table-filter="edit_row">
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
                    const filterSearch = document.querySelector('[data-kt-sopir-table-filter="search"]');
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
                KTDatatablesSopir.init();
            });

            function setSopir(id)
            {
                window.livewire.emit('setSopir', id)
            }

            let modalSopir = new bootstrap.Modal(document.getElementById('modalSopir'));
            window.livewire.on('modalSopirHide', function () {
                modalSopir.hide()
            })
        </script>
    @endpush
</div>
