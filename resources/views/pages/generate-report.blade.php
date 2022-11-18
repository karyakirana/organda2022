<x-metronics>
    <x-molecules.card title="Laporan Customer">
        <x-atoms.table>
            @foreach($customer as $row)
                <tr>
                    <x-atoms.table.td>{{$loop->iteration}}</x-atoms.table.td>
                    <x-atoms.table.td>{{$row->nama_cust}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->yoman}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->lamong}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->sum_stid}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$row->sum_mypertamina}}</x-atoms.table.td>
                </tr>
            @endforeach
            <x-slot:footer>
                <tr>
                    <x-atoms.table.td colspan="2"></x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('yoman')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('lamong')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('sum_stid')}}</x-atoms.table.td>
                    <x-atoms.table.td align="center">{{$customer->sum('sum_mypertamina')}}</x-atoms.table.td>
                </tr>
            </x-slot:footer>

        </x-atoms.table>
    </x-molecules.card>

</x-metronics>