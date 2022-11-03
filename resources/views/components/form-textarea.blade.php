<div>
    <label for="{{ $name }}">{{ $label ? $label : $name }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror">{{ old($name) ?? $defaultValue }}</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
