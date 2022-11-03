<div class="mb-2">
    <label for="{{ $name }}">{{ $label ? $label : $name }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option value="">Pilih</option>
        @foreach ($dataArr as $da)
            <option value="{{ old($name) ? old($name) : $da['key'] }}" @if ($da['key'] == $defaultValue || $da['key'] == old($name)) selected @endif>
                {{ $da['val'] }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
