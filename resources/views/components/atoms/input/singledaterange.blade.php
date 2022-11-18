@aware(['error', 'name'])
@props(['name'=>''])
<input type="text" {{$attributes->class(['form-control tanggalan', 'is-invalid'=>$errors->has($name)])}} readonly>
@push('scripts')
    <script>
        $(".tanggalan").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: "YYYY-MM-DD"
            }
        });
    </script>
@endpush
