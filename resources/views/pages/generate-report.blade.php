<x-metronics>
    <x-molecules.card title="Laporan Customer">
        <x-slot:toolbar>
            <x-atoms.button.btn-link-primary href="{{route('report.print')}}" target="_blank">PRINT</x-atoms.button.btn-link-primary>
        </x-slot:toolbar>
        <x-atoms.table id="dataCustomer">
            <x-slot:head>
                <tr>
                    <x-atoms.table.td>NO</x-atoms.table.td>
                    <x-atoms.table.td>Customer</x-atoms.table.td>
                    <x-atoms.table.td>Sopir</x-atoms.table.td>
                    <x-atoms.table.td>BAT</x-atoms.table.td>
                    <x-atoms.table.td>Lamong</x-atoms.table.td>
                    <x-atoms.table.td>STID</x-atoms.table.td>
                    <x-atoms.table.td>MyPertamina</x-atoms.table.td>
                </tr>
            </x-slot:head>
            @foreach($customer as $row)
                <tr>
                    <x-atoms.table.td>{{$loop->iteration}}</x-atoms.table.td>
                    <x-atoms.table.td>{{$row->nama_cust}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->sum_sopir}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->yoman}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->lamong}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->sum_stid}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->sum_mypertamina}}</x-atoms.table.td>
                </tr>
            @endforeach
            <x-slot:footer>
                <tr>
                    <x-atoms.table.td colspan="2"></x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('sum_sopir')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('yoman')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('lamong')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('sum_stid')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('sum_mypertamina')}}</x-atoms.table.td>
                </tr>
            </x-slot:footer>

        </x-atoms.table>
    </x-molecules.card>

    @push('scripts')
        <script>
            $("#dataCustomer").DataTable({

            });
        </script>
    @endpush

</x-metronics>
