<div class="wrap">
  <div id="icon-options-general" class="icon32"><br /></div>
  <h2>Culture24 Options</h2>
  <p>Plugin Version 1.0.2</p>
  <div id="c24-admin">
    <form method="post" action="options.php">
      <?php
      settings_fields('c24_options_group_api');
      do_settings_sections('c24-settings-api');
      ?>
      <?php submit_button(); ?>
    </form>

  </div>  <!--id="c24_admin"-->
</div>   <!--class="wrap" -->