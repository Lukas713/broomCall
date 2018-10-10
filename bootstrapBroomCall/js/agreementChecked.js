<script>
        $(".changeCheck").click(function(){

            var x = $(this).attr('id');
            x = x.split('-');

            $.ajax({
                type: "POST",
                url: "../private/approveSquad.php",
                data: "fifi="+x[0],
                success: function(serveReturn){
                    console.log(serveReturn);
                }
            });
        });
</script>