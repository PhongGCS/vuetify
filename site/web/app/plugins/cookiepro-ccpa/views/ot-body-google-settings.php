<?php
/**
 * Form Google Opt settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label" for="buttom-left">
		<?php echo esc_html( $this->banner_settings_constant['constant']['googleSettingLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="ot-checkbox" name="isGooglePersonalizeEnabled" id="isGooglePersonalizeEnabled" type="checkbox"
			<?php echo esc_attr( $this->banner_settings_constant['behavior']['isGooglePersonalizeEnabled'] ); ?>>
		<span class="ot-checkbox-text">
			<?php echo esc_html( $this->banner_settings_constant['constant']['googleSettingDescription'] ); ?>
		</span>
	</div>
</div>
<div class="form-control-group" id="iabccpa">
	<label class="form-control-label" for="buttom-left"></label>
	<div class="form-control">
		<input class="ot-checkbox" name="isIABEnabled" id="isIABEnabled" type="checkbox" value="iab"
			<?php echo esc_attr( $this->banner_settings_constant['behavior']['isIABEnabled'] ); ?>>
		<span class="ot-checkbox-text">
			<?php echo esc_html( $this->banner_settings_constant['constant']['isIABEnabledlabel'] ); ?>
		</span>
	</div>
</div>
<div class="form-control-group" id="laspoption">
	<label class="form-control-label" for="buttom-left"></label>
	<div class="form-control lspasection">
		<input class="ot-checkbox" name="isLSPAenable" id="LSPAOption" type="checkbox" <?php echo esc_attr( $this->banner_settings_constant['behavior']['isLSPAenable'] ); ?>>
		<span class="ot-checkbox-text">
			<?php echo esc_html( $this->banner_settings_constant['constant']['isLSPAlabel'] ); ?>
		</span>
	</div>
</div>
<div class="form-control-group GooglePersonalize">
	<label class="form-control-label" for="googleConfirmationTitle">
		<?php echo esc_html( $this->banner_settings_constant['constant']['googleSettingConfirmationTitle'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Googledisable" name="googleConfirmationTitle" type="Text" placeholder="Personalized advertisements"
			value='<?php echo esc_attr( stripslashes( $this->banner_settings_constant['behavior']['googleConfirmationTitle'] ) ); ?>'>
	</div>
</div>

<div class="form-control-group GooglePersonalize">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['googleSettingConfirmationMessage'] ); ?>
	</label>
	<div class="form-control confirmmsg">
		<textarea class="form-textarea Googledisable" name="googleConfirmationMessage" rows="6"><?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['googleConfirmationMessage'] ) ); ?></textarea>
	</div>
</div>

<div class="form-control-group GooglePersonalize">
	<label class="form-control-label" for="confirmbutton">
		<?php echo esc_html( $this->banner_settings_constant['constant']['confirmbuttonlabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Googledisable" name="confirmbutton" type="Text" placeholder="Button Text"
			value='<?php echo esc_attr( stripslashes( $this->banner_settings_constant['behavior']['confirmbutton'] ) ); ?>'>
	</div>
</div>