<div>
    <x-molecules.modal size="xl" title="Detail MyPertamina" id="detailMyPertaminaModal">
        @if($detailMyPertamina)
            <x-atoms.table>
                <x-slot:head>
                    <tr>
                        <x-atoms.table.td>ID</x-atoms.table.td>
                        <x-atoms.table.td>Customer</x-atoms.table.td>
                        <x-atoms.table.td>Nopol</x-atoms.table.td>
                        <x-atoms.table.td>Status</x-atoms.table.td>
                    </tr>
                </x-slot:head>
                @foreach($detailMyPertamina as $row)
                    <tr>
                        <x-atoms.table.td>{{$row->id_mypertamina}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->customer->nama_cust}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->nopol}}</x-atoms.table.td>
                        <x-atoms.table.td>{{$row->status}}</x-atoms.table.td>
                    </tr>
                @endforeach
            </x-atoms.table>
        @endif
        <x-slot:footer></x-slot:footer>
    </x-molecules.modal>

    @push('scripts')
        <script>
            let detailMyPertaminaModal = new bootstrap.Modal(document.getElementById('detailMyPertaminaModal'));

            document.getElementById('detailMyPertaminaModal').addEventListener('hidden.bs.modal', function () {
                window.livewire.emit('resetDetail')
            })

            window.livewire.on('detailMyPertaminaModalShow', function () {
                detailMyPertaminaModal.show()
            })
        </script>
    @endpush
</div>
