@php
use App\Models\Checklist;
use Illuminate\Support\Carbon;
$user = auth()->user()->id;
$checklists = Checklist::where('verificacion', '0')->get();
foreach($checklists as $c) {
    $today = Carbon::now();
    if ($c->employee_id != 1 && $c->enabled && $today->greaterThanOrEqualTo($c->expiration)) {
        $c->expired = true;
        $c->enabled = false;
        $c->update();
    }
}


$checklists = Checklist::where('employee_id', auth()->user()->id)
    //->orWhere('supervisor_id', $user)
    ->get();
// dd($checklists);
if (!$checklists->isEmpty()) {
    $alarm = false;
    $today = Carbon::now();
    foreach ($checklists as $c) {
        if ($c->verificacion == '0' && $today->diffInMinutes($c->expiration, false) <= 60 && !$c->expired) {
            $alarm = true;
            break;
        }
    }
    if ($alarm == true) {
        session()->flash('warning', 'Tiene checklists proximos a vencer');
    }
}
@endphp
