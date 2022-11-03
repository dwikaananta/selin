<div class="mb-2">
    <label for="{{ $name }}">{{ $label ? $label : $name }}</label>
    <input name="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"
        value="{{ old($name) ? old($name) : $defaultValue }}" id="{{ $name }}">
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
