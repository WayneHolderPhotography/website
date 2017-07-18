  </div> <!-- End #wrapper -->
  <!-- Start Footer -->
  <footer>
    <div class="footer page">
      <div class="row">
        <div class="small-12 large-3 columns">
          <?php dynamic_sidebar( 'footer-column-left' ); ?>
        </div>

        <div class="small-12 large-3 columns">
          <?php dynamic_sidebar( 'footer-column-center-left' ); ?>
        </div>

        <div class="small-12 large-3 columns">
          <?php dynamic_sidebar( 'footer-column-center-right' ); ?>
        </div>

        <div class="small-12 large-3 columns">
          <?php dynamic_sidebar( 'footer-column-right' ); ?>
        </div>
      </div>
    </div><!-- End Footer -->
  </footer>

  <?php wp_footer(); ?>

  <?php if(!is_home() || !is_front_page()) : ?>
    <script> Pace.stop(); </script>
   <?php endif; ?>
</body>
</html>
