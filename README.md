#38527E

@foreach ($listCharacteristics as $listCharacteristic)
<div class="form-check d-flex align-items-center">
    <label class="form-check-label" for="flexCheckDefault">{{ $listCharacteristic->name_characteristic }}</label>
    <!-- Logika untuk checked -->
    <input class="form-check-input ms-auto characteristic" type="checkbox" value="{{ $listCharacteristic->id }}"
        style="border-color: #38527E;" @if (in_array($listCharacteristic->id, $characteristics->pluck('id')->toArray()))
    checked
    @endif
    >
</div>
@endforeach