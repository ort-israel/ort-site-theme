<aside class="school-custom-fields">

    <div class="schoolmaster-info">
		<?php $utils->display_advanced_custom_field( 'ort_schoolmaster_picture', 'img' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_schoolmaster_name', 'span', '', '', true ); ?>
    </div>


    <div class="school-info">
		<?php $utils->display_advanced_custom_field( 'ort_school_phone', 'span', 'fa-phone' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_email', 'span', 'fa-envelope' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_site', 'span', 'fa-window-maximize' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_address', 'span', 'fa-map-marker-alt' ); ?>
    </div>

    <div class="school-social-media">
		<?php $utils->display_advanced_custom_field( 'ort_school_facebook', 'a', 'fa-facebook' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_instagram', 'a', 'fa-instagram' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_youtube', 'a', 'fa-youtube-square' ); ?>
    </div>
    <div class="school-map">
		<?php $utils->display_advanced_custom_field( 'ort_school_map_iframe', '' ); ?>
    </div>
</aside>
