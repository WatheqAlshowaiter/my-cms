<footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; my Website <?php echo date("Y"); ?></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->

<!--     
    <script src="/diaz/mine/cms2/vendor/jquery/jquery.min.js"></script>
    <script src="/diaz/mine/cms2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <?php// __FILE__ . "/vendor/jquery/jquery.min.js"; ?> 

      <!-- important code in php 
        "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).
       -->
       
      
    <script src="<?= $base_url;?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ;?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
