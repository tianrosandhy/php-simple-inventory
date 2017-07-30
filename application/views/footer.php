
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <?php cms_register("footer")?>
    <script>
        $(function(){
            <?=$this->cms->show_alert()?>
            $(".delete-button").on("click",function(e){
                e.preventDefault();
                target = $(this).attr("href");
                alertify.confirm('<strong>Hapus Data?</strong>','Apakah Anda yakin ingin membuang data ini ke tempat sampah?', function(){
                        window.location = target;
                    }, function(){});
            });

            $("#saveproj").on("click",function(e){
                e.preventDefault();
                nm = $("#saveprojtxt").val();
                target = "history/new_periode?nm="+nm;
                alertify.confirm('<strong>Warning?</strong>','Anda yakin ingin menutup data periode ini dan membuat yang baru? Data periode lama nantinya tidak dapat diubah lagi.', function(){
                        window.location = target;
                    }, function(){});
            });
            $("#saveprojtxt").on("keydown",function(e){
                if(e.which == 13){
                    nm = $("#saveprojtxt").val();
                    target = "history/new_periode?nm="+nm;
                    alertify.confirm('<strong>Warning?</strong>','Anda yakin ingin menutup data periode ini dan membuat yang baru? Data periode lama nantinya tidak dapat diubah lagi.', function(){
                            window.location = target;
                        }, function(){});
                }
            });

        });

        $("[data-fancybox]").fancybox({
          afterClose: function() {
            location.reload();
          }
        });

        $(".slug-toggle").change(function(){
            txt = convertToSlug($(this).val());
            $(".slug-target").val(txt);
        });

        function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }


        $(".new-button").on("click",function(){
            var target = $(this).attr("data-target");
            $(this).hide(200);
            $("#"+target).show();
        });
        $(".close-button").on("click",function(){
            var target = $(this).attr("data-target");
            $("#"+target).hide(200);
            $(".new-button").show();  
        });



       







    </script>
</body>

</html>
