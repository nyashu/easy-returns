@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Generate Store URL </h3>

                            </div>
                        </div>
                    </div>

                    <div class="clipboard-example align-items-center w-50 p-4">
                        <div class="input-group mb-3">
                            <input id="in01"
                                   type="text"
                                   class="form-control"
                                   placeholder="BTC Address..."
                                   aria-label="BTC Address"
                                   aria-describedby="btn01"
                                   value="{{ config('app.url') . '/easy-return/create?store=' . strtolower(auth()->user()->id)}}"
                                   readonly
                            >
                            <button id="btn01"
                                    class="btn btn-secondary"
                                    type="button"
                                    data-clipboard-demo=""
                                    data-clipboard-target="#in01"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Copy to Clipboard"
                            >Copy</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
<script>
    let btn = document.getElementById('btn01');
    let clipboard = new ClipboardJS(btn);

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
</script>

@endpush
