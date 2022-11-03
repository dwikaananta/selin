<div>
    @if ($submit)
        <button type="submit" class="btn btn-primary">Simpan</button>
    @endif
    @if ($linkBack)
        <a href="{{ $linkBack }}" class="btn btn-secondary">Kembali</a>
    @else
        <button id="back" type="button" class="btn btn-secondary">Kembali</button>
        <script>
            document.getElementById('back').addEventListener('click', () => {
                let link = '/' + window.location.pathname.split('/')[1];
                window.location = link;
            })
        </script>
    @endif
</div>
