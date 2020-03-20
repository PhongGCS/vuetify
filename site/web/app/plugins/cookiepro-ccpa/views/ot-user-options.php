<?php
/**
 * Form privacy policy settings
 *
 * @package CookieProCCPA
 */

?>
<?php 
	$user_option_one   = 'All';
	$user_option_two   = 'US';
	$user_option_three = 'California';
?>
<div class="form-control-group">
	<label class="form-control-label" for="selectuseroption">
		<?php echo esc_html( $this->banner_settings_constant['constant']['selectuseroption'] ); ?>
	</label>
	<div class="form-control">
		<input class="ot-checkbox" name="selectuseroption" id="selectuseroption" type="radio" value="<?php echo esc_attr( $user_option_one ); ?>" <?php if( $user_option_one === $this->banner_settings_constant['behavior']['selectuseroption'] || empty( $this->banner_settings_constant['behavior']['selectuseroption'] ) ){ echo 'checked'; } ?>>
		<span class="ot-checkbox-text">Show to all users</span><br>
	</div>
</div>	
<div class="form-control-group">
	<label class="form-control-label" for="selectuseroption"></label>		
	<div class="form-control">	
		<input class="ot-checkbox" name="selectuseroption" id="selectuseroption" type="radio" value="<?php echo esc_attr( $user_option_two ); ?>" <?php if( $user_option_two === $this->banner_settings_constant['behavior']['selectuseroption'] ) { echo 'checked'; } ?>>
		<span class="ot-checkbox-text">Show only to users from the US</span><br>
	</div>
</div>
<div class="form-control-group">
	<label class="form-control-label" for="selectuseroption"></label>	
	<div class="form-control">		
		<input class="ot-checkbox" name="selectuseroption" id="selectuseroption" type="radio" value="<?php echo esc_attr( $user_option_three ); ?>" <?php if( $user_option_three === $this->banner_settings_constant['behavior']['selectuseroption'] ){ echo 'checked'; } ?> >
		<span class="ot-checkbox-text">Show only to users from california</span>				
	</div>
</div>