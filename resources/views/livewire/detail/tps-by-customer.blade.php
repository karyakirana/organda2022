<div>
    <x-molecules.modal size="xl" title="Detail TPS" id="detailTpsModal">
        @if($detailTps)
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
                @foreach($detailTps as $row)
                    <tr>
                        <x-atoms.table.td>{{$row->id_transaksitps}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->sopir->customer->nama_cust}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->sopir->nama_sopir}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->nik_tps}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->status}}</x-atoms.table.td>
                    </tr>
                @endforeach
            </x-atoms.table>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let detailTpsModal = new bootstrap.Modal(document.getElementById('detailTpsModal'));

            document.getElementById('detailTpsModal').addEventListener('hidden.bs.modal', function () {
                window.livewire.emit('resetDetail')
            })

            window.livewire.on('detailTpsModalShow', function () {
                detailTpsModal.show()
            })
        </script>
    @endpush
</div>
