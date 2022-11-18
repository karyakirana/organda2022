<div>
    <x-molecules.modal size="xl" title="Detail STID" id="detailStidModal">
        @if($detailStid)
            <x-atoms.table>
                <x-slot:head>
                    <tr>
                        <x-atoms.table.td>ID</x-atoms.table.td>
                        <x-atoms.table.td>Customer</x-atoms.table.td>
                        <x-atoms.table.td>Nopol</x-atoms.table.td>
                        <x-atoms.table.td>Kode</x-atoms.table.td>
                        <x-atoms.table.td>Masa Berlaku</x-atoms.table.td>
                        <x-atoms.table.td>Status</x-atoms.table.td>
                        <x-atoms.table.td></x-atoms.table.td>
                    </tr>
                </x-slot:head>
                @foreach($detailStid as $row)
                    <tr>
                        <x-atoms.table.td>{{$row->id_stid}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->customer->nama_cust}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->nopol}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->kode}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->masa_berlaku}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->status}}</x-atoms.table.td>
                    </tr>
                @endforeach
            </x-atoms.table>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let detailStidModal = new bootstrap.Modal(document.getElementById('detailStidModal'));

            document.getElementById('detailStidModal').addEventListener('hidden.bs.modal', function () {
                window.livewire.emit('resetDetail')
            })

            window.livewire.on('detailStidModalShow', function () {
                detailStidModal.show()
            })
        </script>
    @endpush
</div>
