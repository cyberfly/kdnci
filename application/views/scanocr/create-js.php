<script>

    $(document).ready(function(){

        $( "#preview" ).click(function() {
            // set hidden action value as preview
            $("#action").val('preview');

            // submit form    
            $("#ocr_form").submit();
        });

        $( "#save" ).click(function() {
            // set hidden action value as submit
            $("#action").val('submit');

            // submit form
            $("#ocr_form").submit();
        });    

    });

</script>