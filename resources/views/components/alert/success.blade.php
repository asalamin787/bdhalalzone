<script>
   
    $(document).ready(function() {
        toastr.success("{{ session('success_msg') }}", "Success")
    });
</script>
