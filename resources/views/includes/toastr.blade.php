@if (Session::has('success'))
    toastr.success('{{Session::get('success')}}','Success', {timeOut: 5000})
@endif

@if (Session::has('info'))
    toastr.info('{{Session::get('info')}}','Info', {timeOut: 5000})
@endif

@if (Session::has('warning'))
    toastr.warning('{{Session::get('warning')}}','Warning', {timeOut: 5000})
@endif

@if (Session::has('error'))
    toastr.error('{{Session::get('error')}}','Error', {timeOut: 5000})
@endif