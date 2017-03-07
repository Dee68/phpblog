  <!-- jQuery Version 1.11.1 -->

   <script src = "../../assets/admin/js/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/admin/js/bootstrap.min.js"></script>
    <script src="../../assets/js/bootstrap-datetimepicker.js"></script>
    <script>
    $(document).ready(function(){
    $(function() {
           $( "#datepicker" ).datetimepicker({ format: "yyyy.mm.dd",
        minDate: 0,
        showOtherMonths: true,
        firstDay: 1});
           $( "#datetpicker" ).datetimepicker("show");
        });
        });
    </script>

</body>

</html>