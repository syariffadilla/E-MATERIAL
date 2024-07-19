@if (session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: `{{ session('color') }}`,
            title: `{{ session('status') }}`
        })
        // Swal.fire(
        //     'Warning',
        //     `{{ session('status') }}`,
        //     `{{ session('color') }}`
        // )
    </script>
@endif
