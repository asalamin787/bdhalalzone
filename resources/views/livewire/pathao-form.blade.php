@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Customize the Select2 container to use Bootstrap styles */
        .select2-container--bootstrap-5 .select2-selection--single {
            height: 50px;
            padding: 10px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 5px;

            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            padding-right: 0;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem + 2px);
            right: 0.75rem;
        } /* Customize the dropdown menu */ 
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.375rem 0.75rem;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
            background-color: #e9ecef;
            color: #495057;
        }
    </style>
@endpush
<div class="row">
    <div class="form-group col-4">
        <label for="city">City</label>
        <select id="city-select" wire:model="selectedCity" name="pathao[city]" class="form-control">
            <option value="">Select City</option>
            @foreach ($cities as $id => $city)
                <option value="{{ $id }}">{{ $city }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-4">
        <label for="zone">Zone</label>
        <select id="zone-select" wire:model="selectedZone" name="pathao[zone]" class="form-control">
            <option value="">Select Zone</option>
            @foreach ($zones as $id => $zone)
                <option value="{{ $id }}">{{ $zone }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-4">
        <label for="area">Area</label>
        <select id="area-select" wire:model="selectedArea" name="pathao[area]" class="form-control">
            <option value="">Select Area</option>
            @foreach ($areas as $id => $area)
                <option value="{{ $id }}">{{ $area }}</option>
            @endforeach
        </select>
    </div>
</div>
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            $('#city-select').select2({
                theme: 'bootstrap-5'
            });
            $('#zone-select').select2({
                theme: 'bootstrap-5'
            });
            $('#area-select').select2({
                theme: 'bootstrap-5'
            });

            $('#city-select').on('change', function(e) {
                var data = $(this).val();
                @this.set('selectedCity', data);
            });

            $('#zone-select').on('change', function(e) {
                var data = $(this).val();
                @this.set('selectedZone', data);
            });

            $('#area-select').on('change', function(e) {
                var data = $(this).val();
                @this.set('selectedArea', data);
            });

            Livewire.hook('message.processed', (message, component) => {
                $('#city-select').select2({
                    theme: 'bootstrap-5'
                });
                $('#zone-select').select2({
                    theme: 'bootstrap-5'
                });
                $('#area-select').select2({
                    theme: 'bootstrap-5'
                });
            });
        });
    </script>
@endpush
