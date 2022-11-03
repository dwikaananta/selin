<div class="mb-2">
    <label for="{{ $name }}">{{ $label ? $label : $name }}</label>
    <br>
    @foreach ($dataArr as $da)
        <div class="mb-2 {{ $inline ? 'form-check-inline' : '' }}">
            <input name="{{ $name }}" type="radio" value="{{ old($name) ? old($name) : $da['key'] }}"
                class="form-check-input @error($name) is-invalid @enderror"
                @if ($da['key'] == $defaultValue || $da['key'] == old($name)) checked @endif id="{{ $name . '_' . $da['key'] }}">
            <label class="form-check-label" for="{{ $name . '_' . $da['key'] }}">{{ $da['val'] }}</label>
        </div>
        @if ($loop->last)
            @error($name)
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        @endif
    @endforeach
</div>
