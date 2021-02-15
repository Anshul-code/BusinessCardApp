@if(session('success'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
            
            Toast.fire({
                icon: 'success',
                title: '{{ session("success") }}'
            });
        });
    </script>
@endif
@if(session('error'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });

            Toast.fire({
                icon: 'error',
                title: '{{ session("error") }}'
            });
        });
    </script>
@endif
@if(session('warning'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });

            Toast.fire({
                icon: 'warning',
                title: '{{ session("warning") }}'
            });
        });
    </script>
@endif

