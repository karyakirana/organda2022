<div>
    <x-molecules.modal-notifications wire:ignore.self></x-molecules.modal-notifications>

    <x-molecules.modal id="modalCustomer" title="Form Customer" wire:ignore.self>
        <x-atoms.input.group-horizontal name="id_cust" label="ID" class="mb-5">
            <x-atoms.input.text wire:model.defer="id_cust" disabled />
        </x-atoms.input.group-horizontal>
        <x-atoms.input.group-horizontal name="nama_customer" label="Nama" class="mb-5">
            <x-atoms.input.text wire:model.defer="nama_customer" />
        </x-atoms.input.group-horizontal>
        <x-atoms.input.group-horizontal name="telp_customer" label="Telepon" class="mb-5">
            <x-atoms.input.text wire:model.defer="telp_customer" />
        </x-atoms.input.group-horizontal>
        <x-atoms.input.group-horizontal name="alamat_customer" label="Alamat" class="mb-5">
            <x-atoms.input.text wire:model.defer="alamat_customer" />
        </x-atoms.input.group-horizontal>
        <x-slot:footer>
            @if($update)
                <x-atoms.button.btn-primary wire:click="update">Update</x-atoms.button.btn-primary>
            @else
                {{$update}}
                <x-atoms.button.btn-primary wire:click="store">Simpan</x-atoms.button.btn-primary>
            @endif
        </x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let modalCustomer = new bootstrap.Modal(document.getElementById('modalCustomer'), {keyboard:false});

            document.getElementById('modalCustomer').addEventListener('hidden.bs.modal', function () {
                Livewire.emit('resetForm');
                refreshDatatables();
            })

            Livewire.on('modalCustomerHide', function () {
                modalCustomer.hide()
            })

            Livewire.on('modalCustomerShow', function () {
                modalCustomer.show()
            })

            let modalConfirm = new bootstrap.Modal(document.getElementById('modalDeleteNotification'), {
                keyboard : false
            });

            document.getElementById('modalDeleteNotification').addEventListener('hidden.bs.modal', function () {
                Livewire.emit('resetId');
            })

            Livewire.on('modalNotificationHide', function () {
                modalConfirm.hide()
                refreshDatatables()
            })
        </script>
    @endpush
</div>
