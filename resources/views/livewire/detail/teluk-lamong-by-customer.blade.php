<div>
    <x-molecules.modal size="xl" title="Detail Teluk Lamong" id="detailLamongModal">
        @if($detailTelukLamong)
            <x-atoms.table>
                <x-slot:head>
                    <tr>
                        <x-atoms.table.td>ID</x-atoms.table.td>
                        <x-atoms.table.td>Customer</x-atoms.table.td>
                        <x-atoms.table.td>Sopir</x-atoms.table.td>
                        <x-atoms.table.td>NIK</x-atoms.table.td>
                        <x-atoms.table.td>Status</x-atoms.table.td>
                    </tr>
                </x-slot:head>
                @foreach($detailTelukLamong as $row)
                    <tr>
                        <x-atoms.table.td>{{$row->id_translamong}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->customer->nama_cust}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->sopir->nama_sopir}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->nik_lamong}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->status}}</x-atoms.table.td>
                    </tr>
                @endforeach
            </x-atoms.table>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let detailLamongModal = new bootstrap.Modal(document.getElementById('detailLamongModal'));

            document.getElementById('detailLamongModal').addEventListener('hidden.bs.modal', function () {
                window.livewire.emit('resetDetail')
            })

            window.livewire.on('detailLamongModalShow', function () {
                detailLamongModal.show()
            })
        </script>
    @endpush
</div>
