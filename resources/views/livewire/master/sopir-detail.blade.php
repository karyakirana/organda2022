<div>
    <x-molecules.modal title="Detail Data" size="xl" id="detail">
        @if($id_cust)
            <x-atoms.input.group-horizontal label="ID" class="mb-5">
                <x-atoms.input.plaintext>{{$id_cust}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="Customer" class="mb-5">
                <x-atoms.input.plaintext>{{$nama_cust}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="Nama Sopir" class="mb-5">
                <x-atoms.input.plaintext>{{$nama_sopir}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="Telepon" class="mb-5">
                <x-atoms.input.plaintext>{{$telp_sopir}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="KTP" class="mb-5">
                <x-atoms.input.plaintext>{{$ktp_sopir}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="SIM" class="mb-5">
                <x-atoms.input.plaintext>{{$sim_sopir}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="Alamat" class="mb-5">
                <x-atoms.input.plaintext>{{$alamat_sopir}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
            <x-atoms.input.group-horizontal label="Status" class="mb-5">
                <x-atoms.input.plaintext>{{$status}}</x-atoms.input.plaintext>
            </x-atoms.input.group-horizontal>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let modalDetail = new bootstrap.Modal(document.getElementById('detail'))

            document.getElementById('detail').addEventListener('hidden.bs.modal', function () {
                Livewire.emit('resetForm')
            })

            Livewire.on('detailShow', function () {
                modalDetail.show()
            })
        </script>
    @endpush
</div>
