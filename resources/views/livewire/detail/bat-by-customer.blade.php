<div>
    <x-molecules.modal size="xl" title="Detail Bat" id="detailBatModal">
        @if($detailBat)
            <x-atoms.table>
                <x-slot:head>
                    <tr>
                        <x-atoms.table.td>ID</x-atoms.table.td>
                        <x-atoms.table.td>Customer</x-atoms.table.td>
                        <x-atoms.table.td>Nopol</x-atoms.table.td>
                        <x-atoms.table.td>Nomor BAT</x-atoms.table.td>
                        <x-atoms.table.td>Tanggal</x-atoms.table.td>
                        <x-atoms.table.td></x-atoms.table.td>
                    </tr>
                </x-slot:head>
                @foreach($detailBat as $row)
                    <tr>
                        <x-atoms.table.td>{{$row->id_bat}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->customer->nama_cust}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->mobil->nopol_mobil}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->no_bat}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->tanggal_bat}}</x-atoms.table.td>
                    </tr>
                @endforeach
            </x-atoms.table>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let detailBatModal = new bootstrap.Modal(document.getElementById('detailBatModal'));

            document.getElementById('detailBatModal').addEventListener('hidden.bs.modal', function () {
                window.livewire.emit('resetDetail')
            })

            window.livewire.on('detailBatModalShow', function () {
                detailBatModal.show()
            })
        </script>
    @endpush
</div>
