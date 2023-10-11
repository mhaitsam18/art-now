    <div class="blog_copyright_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <p>Hak Cipta &copy; 2021 <a href="<?= BASEURL?>">ArtNow</a></p>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <ul class="blog_footer_menu">
                        <!-- <li><a href="about.html">About</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Main js file Style-->
<script src="<?= BASEURL; ?>/assets-user/js/jquery.js"></script>
<script src="<?= BASEURL; ?>/assets-user/js/bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>/assets-user/js/theia-sticky-sidebar.js"></script>
<script src="<?= BASEURL; ?>/assets-user/js/plugins/swiper/swiper.min.js"></script>
<script src="<?= BASEURL; ?>/assets-user/js/plugins/magnific/jquery.magnific-popup.min.js"></script>
<script src="<?= BASEURL; ?>/assets-user/js/wow.min.js"></script>
<script>
    $(function(){
        // Pesanan
        hideForm();
    });
    function showForm(){
        $('.btn-pesan').hide();
        $('.form-pesan').show();
    }
    function hideForm(){
        $('.btn-pesan').show();
        $('.form-pesan').hide();
    }
</script>
<script src="<?= BASEURL; ?>/assets-user/js/custom.js"></script>
<!--Main js file Style-->
</body>

</html>