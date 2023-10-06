
@if (session()->has('message'))
    <div class="container"
        x-data="{isVisible: true}"
        x-init="
            setTimeout(()=> {
                isVisible = false
            }, 4000)"
        x-show="isVisible"
        x-transition:enter.duration.1000ms
        x-transition:leave.duration.1000ms >
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-primary">
                    <button class="alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-primary"></i></button>
                    {{ session()->get('message') }}
                </div>
            </div>
        </div>
    </div>
@elseif (session()->has('error'))
    <div class="container"
        x-data="{isVisible: true}"
        x-init="
            setTimeout(()=> {
                isVisible = false
            }, 4000)"
        x-show="isVisible"
        x-transition:enter.duration.1000ms
        x-transition:leave.duration.1000ms >
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-success">
                    <button class="alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-success"></i></button>
                    {{ session()->get('error') }}
                </div>
            </div>
        </div>
    </div>
@elseif (session()->has('warning'))
    <div class="container"
        x-data="{isVisible: true}"
        x-init="
            setTimeout(()=> {
                isVisible = false
            }, 4000)"
        x-show="isVisible"
        x-transition:enter.duration.1000ms
        x-transition:leave.duration.1000ms >
        <div class="row">
            <div class="col-12">
                <br>
                <div class="alert alert-warning">
                    <button class=".alert-dismissible close" data-dismiss="alert"><i class="fa-solid fa-xmark text-warning"></i></button>
                    {{ session()->get('warning') }}
                </div>
            </div>
        </div>
    </div>
@endif
