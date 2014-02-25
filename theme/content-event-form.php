  <form id='c24-form' class="form-wrap" action="<?php print $_SERVER['REQUEST_URI']; ?>" method="POST">
      <?php
      if (function_exists('wp_nonce_field')) {
        wp_nonce_field('c24-test', 'c24');
      }
      ?>
      <table class="form-table">
        <tr>
          <td>
            <label for="tag" style="display:inline;">Tag</label>
            <input id="tag" name="tag" type="text" size="32" value="<?php echo (isset($_POST['tag']) ? $_POST['tag'] : get_option('c24api_tag', 'First World War Centenary')); ?>" />
            <label for="elements" style="display:inline;">Elements</label>
            <input id="elements" name="elements" type="text" size="64" value="<?php echo (isset($_POST['elements']) ? $_POST['elements'] : ''); ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="keyfield" style="display:inline;">Keywords Field</label>
            <select id="keyfield" name="keyfield">
              <option value="" <?php echo ($_POST['keyfield'] == '' ? 'selected' : ''); ?> >All</option>
              <option value="name" <?php echo ($_POST['keyfield'] == 'name' ? 'selected' : ''); ?> >Name</option>
              <option value="type" <?php echo ($_POST['keyfield'] == 'type' ? 'selected' : ''); ?> >Type</option>
              <option value="nationalCurriculumTag" <?php echo ($_POST['keyfield'] == 'nationalCurriculumTag' ? 'selected' : ''); ?> >Curriculum Tag</option>
              <option value="audience" <?php echo ($_POST['keyfield'] == 'audience' ? 'selected' : ''); ?> >Audience</option>
              <option value="uniqueID" <?php echo ($_POST['keyfield'] == 'uniqueID' ? 'selected' : ''); ?> >ID</option>
              <option value="venueID" <?php echo ($_POST['keyfield'] == 'venueID' ? 'selected' : ''); ?> >Venue ID</option>
            </select>
            <label for="keywords" style="display:inline;">Keywords</label>
            <input id="keywords" name="keywords" type="text" size="32" value="<?php echo (isset($_POST['keywords']) ? $_POST['keywords'] : ''); ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="offset" style="display:inline;">Offset</label>
            <input id="offset" name="offset" type="text" size="1" value="<?php echo (isset($_POST['offset']) ? $_POST['offset'] : '0'); ?>" />
            <label for="limit" style="display:inline;">Limit</label>
            <input id="limit" name="limit" type="text" size="1" value="<?php echo (isset($_POST['limit']) ? $_POST['limit'] : '2'); ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="date-start" style="display:inline;">Date Start</label>
            <input id="date-start" name="date-start" class="datepicker" type="text" value="<?php echo $date_start; ?>" />
            <label for="date-end" style="display:inline;">Date End</label>
            <input id="date-end" name="date-end" class="datepicker" type="text" value="<?php echo $date_end; ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="map" style="display:inline;">Display Map?</label>
            <select id="map" name="map">
              <option value="" <?php echo ($_POST['map'] == '' ? 'selected' : ''); ?> >No Map</option>
              <option value="7" <?php echo ($_POST['map'] == '7' ? 'selected' : ''); ?> >Large</option>
              <option value="6" <?php echo ($_POST['map'] == '6' ? 'selected' : ''); ?> >Medium</option>
              <option value="5" <?php echo ($_POST['map'] == '5' ? 'selected' : ''); ?> >Small</option>
            </select>
            <label for="debug" style="display:inline;">Display Debug Summary?</label>
            <input type="checkbox" name="debug" id="debug" value="1" <?php echo isset($_POST['debug']) ? 'checked' : ''; ?>/>
            <label for="debug-raw" style="display:inline;">Display Raw Records?</label>
            <input type="checkbox" name="debug-raw" id="debug-raw" value="1" <?php echo isset($_POST['debug-raw']) ? 'checked' : ''; ?>/>
          </td>
        </tr>
        <tr>
          <td>
            <label for="region" style="display:inline;">Region</label>
            <select id="region" name="region">
              <option value=""></option>
              <?php
              foreach ($c24regions as $v) {
                ?>
                <option value="<?php echo $v; ?>" <?php echo ($_POST['region'] == $v ? 'selected' : ''); ?> ><?php echo $v; ?></option>
                <?php
              }
              ?>
            </select>
            <label for="audience" style="display:inline;">Audience</label>
            <select id="audience" name="audience">
              <option value=""></option>
              <?php
              foreach ($c24audiences as $v) {
                ?>
                <option value="<?php echo $v; ?>" <?php echo ($_POST['audience'] == $v ? 'selected' : ''); ?> ><?php echo $v; ?></option>
                <?php
              }
              ?>
            </select>
            <label for="type" style="display:inline;">Type</label>
            <select id="type" name="type">
              <option value=""></option>
              <?php
              foreach ($c24types as $v) {
                ?>
                <option value="<?php echo $v; ?>" <?php echo ($_POST['type'] == $v ? 'selected' : ''); ?> ><?php echo $v; ?></option>
                <?php
              }
              ?>
            </select>
          </td>
        </tr>
      </table>
      <br />
      <input class="button-primary" type="submit" name="c24_btn_fetch" id="c24_btn_fetch" value="Fetch" />
      <hr />
    </form><!-- id="c24_form" -->