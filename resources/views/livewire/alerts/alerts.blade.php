<div>
    <div>
        @if (session()->has('update'))
        <div id="alert" class="badge alert-info fade show roll-in-right" role="alert">
            <strong>
                تعديل
            </strong> {{ session('update') }}
        </div>
        @endif
    </div>
    <div>
        @if (session()->has('success'))
        <div id="alert" class="badge alert-success fade show roll-in-right" role="alert">
            <strong>
                نجاح
            </strong> {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        @if (session()->has('error'))
        <div id="alert" class="badge alert-danger fade show roll-in-right" role="alert">
            <strong>
                خطأ
            </strong> {{ session('error') }}
        </div>
        @endif
    </div>
    <div>
        @if (session()->has('warning'))
        <div id="alert" class="badge alert-warning  fade show roll-in-right" role="alert">
            <span>
                <strong>
                    تنبيه
                </strong> {{ session('warning') }}
            </span>
        </div>
        @endif
    </div>
</div>