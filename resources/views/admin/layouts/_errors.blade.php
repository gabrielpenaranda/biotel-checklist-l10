<div class="container"
        x-data="{isVisible: true}"
        x-init="
            setTimeout(()=> {
                isVisible = false
            }, 4000)
        "
        x-show="isVisible"
        x-transition:enter.duration.1000ms
        x-transition:leave.duration.1000ms>
    <div class="row">
        <div class="col-12">
            @if (count($errors) > 0)
                <br>
                <div class="alert alert-danger" role="alert">
                    <button class="alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-success"></i></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
