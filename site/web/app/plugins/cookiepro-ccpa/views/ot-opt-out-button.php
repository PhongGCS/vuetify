<?php
/**
 * Form privacy policy settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['OptoutButtonEnable'] ); ?>
	</label>
	<div class="form-control selectoption">
		<input type="radio" name="isLinkEnabled" id="isLinkEnabled" value="textlink"
			<?php if( 'textlink' === $this->banner_settings_constant['field']['isLinkEnabled'] ){ echo 'checked'; } ?>>
			<span><?php echo esc_html( $this->banner_settings_constant['constant']['isLinkEnabled'] ); ?></span>
	</div>

	<div class="form-control selectoption">
		<input type="radio" class="ot-checkbox" name="isLinkEnabled" id="OptoutButtonEnable" value="buttonlink"
			<?php if( 'buttonlink' === $this->banner_settings_constant['field']['isLinkEnabled'] ){ echo 'checked'; } ?>>
		<span class="ot-checkbox-text">Button</span>
	</div>	
</div>
<div class="form-control-group group-optout-button"> 
	<label class="form-control-label"></label>       
	<div class="form-control group-optout-textbox textboxsnippet" id="buttonlink" style="display: none;">
		<label class="form-control-label-side-bar">
			<span class="subtext">Copy and paste the following snippet onto your website.</span>
		</label>		
		<div id="optouttooltipDiv" class="tooltip"></div>
		<div class="snippet">
			<input id="ot-ccpa-optout-text" class="form-textbox" name="button-text" type="Text" readonly
				value='<button type="button" data-ot-ccpa-opt-out="button" style="display:none;" class="ot-ccpa-optout__button ot-ccpa-optout__button--light"><img src="https://cookie-cdn.cookiepro.com/ccpa-optout-solution/v1/assets/icon-do-not-sell.svg" style="width:30px;height:30px;" alt="" role="presentation"><span class="ot-ccpa-optout__button__title">Do Not Sell My Personal Information</span></button>'>
			<input id="ot-ccpa-optout-button" class="white-button" type="button" title="copy snippet"
				value="<?php echo esc_attr( $this->banner_settings_constant['constant']['snippetButtonText'] ); ?>">
		</div>
	</div>
       
	<div class="form-control group-linktext textboxsnippet" id="textlink" style="display: none;">
		<label class="form-control-label-side-bar">
			<span class="subtext">Copy and paste the following snippet onto your website.</span>
		</label>
		<div id="tooltipDiv" class="tooltip"></div>
		<div class="snippet">			
			<input id="ot-ccpa-snippet-text" class="form-textbox width-70" name="button-text" type="Text" readonly
				value="<a id='otCCPAdoNotSellLink' href='javascript:void(0);' data-ot-ccpa-opt-out='link'>Do Not Sell My Personal Information</a>">
			<input id="ot-ccpa-snippet-button" class="white-button" type="button" title="copy snippet"
				value="<?php echo esc_attr( $this->banner_settings_constant['constant']['snippetButtonText'] ); ?>">
		</div>
	</div>

</div>