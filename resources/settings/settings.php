<?php

use DT\Contact\Views\Dtc;
use DT\Contact\Models\Options;
?>
<p>this setting</p>
<form id="rt-tpg-settings-form">
      <?php $settings = get_option( DtContact()->options['settings'] ); ?>
      <ul>
            <li>
                  <a href="">Tab1</a>
            </li>
            <li>
                  <a href="">Tab2</a>
            </li>
            <li>
                  <a href="">Tab3</a>
            </li>
      </ul>
      <?php
            $html = null;
            $html .= sprintf( '<div id="common-settings" class="rt-tab-content"%s>', $last_tab == 'common-settings' ? ' style="display:block"' : '' );
            $html .= Dtc::rtFieldGenerator( Options::dtCSettingsOtherSettingsFields() );
	      $html .= '</div>';
            // Dtc::print_html( $html, true );
            echo  $html;

      ?>

            <p class="submit-wrap"><input type="submit" name="submit" class="button button-primary rtSaveButton" value="Save Changes"></p>


</form>
