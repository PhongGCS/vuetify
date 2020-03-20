<?php
/**
 * Client side banner content
 *
 * @package CookieProCCPA
 */

?>
<?php
	wp_register_style( 'otCCPAStylegooglefont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap', '', '1.0', false );
	wp_enqueue_style( 'otCCPAStylegooglefont' );
?>
<style>
#ot-ccpa-banner {
	font-family: "Open Sans"; 
	margin: 0; 
	padding: 0;
	position: 
	fixed;
	bottom: 0;
	left: 1%;
	max-width: 400px;
	background-color: transparent;
	z-index: 9999;
	margin-right: 20px; 
}
#ot-ccpa-banner .ot-ccpa-icon {
	position: absolute; 
	bottom: 10px; 
	left: 0; 
	width: 50px;
	line-height: 15px;
	cursor: pointer;
	padding: 8px;
	background-color: #6699CC;
	border-radius: 10px; 
	height: 50px;
	display: flex; 
	justify-content: center; 
	align-items: center;
}
#ot-ccpa-banner .ot-ccpa-icon img{ 
	width: 100%; 
}

.CCPAFloatRight{ 
	right: 1% ; 
	left: auto !important; 
}
.ot-ccpa-optout__button--light{
	display: <?php if( 'buttonlink' === $this->linkenable['isLinkEnabled'] ) { echo 'inline-block'; } else { echo 'none !important'; } ?>
}
</style>
<script>
jQuery(function(){
    jQuery("#ot-ccpa-banner,#otCCPAdoNotSellLink,.ot-ccpa-optout__button").click(function(){
        jQuery("#ot-ccpa-banner").toggle();
    });
    jQuery(document).on('click','.ot-ccpa-optout__buttons__close, .ot-ccpa-optout__confirm',function(){
        setTimeout(function(){
            if(jQuery(".ot-ccpa-icon").hasClass("enableicon")){ jQuery("#ot-ccpa-banner").show(); }
        }, 300);
    });
});
</script>
<?php if ( 'checked' !== $this->linkenable['isLinkEnabled'] && 'textlink' !== $this->linkenable['isLinkEnabled'] ) { ?>
	<style type="text/css">#otCCPAdoNotSellLink{ display: none !important; }</style>
<?php } ?>
<?php
	$class = '';
	if ( 'right' === $this->banner_settings['DisplayPosition'] ) {
		$class = 'CCPAFloatRight';
	}
	$emailenable = 'false';
	if( 'checked' === $this->behavior_settings['isEmailEnabled'] ) {
		$emailenable = 'true';
	} 
	$phoneenable = 'false';
	if( 'checked' === $this->behavior_settings['isPhoneEnabled'] ) {
		$phoneenable = 'true';
	}
	$formenable = 'false';
	if( 'checked' === $this->behavior_settings['form_enable'] ) {
		$formenable = 'true';
	}
	$isLSPAenable = 'false';
	if( isset( $this->behavior_settings['isLSPAenable'] ) ) {
		if( 'checked' === $this->behavior_settings['isLSPAenable'] ) {
			$isLSPAenable = 'true';
		}
	}
	$isGooglePersonalizeEnabled = '';
	if( 'checked' === $this->behavior_settings['isGooglePersonalizeEnabled'] ) {
		$isGooglePersonalizeEnabled = 'gam';
	}	
	$frameworks = '';
	if( isset( $this->behavior_settings['isIABEnabled'] ) ) { 
		if( 'checked' === $this->behavior_settings['isIABEnabled'] && 'checked' === $this->behavior_settings['isGooglePersonalizeEnabled'] ){
			$frameworks = 'iab'; 
		}
	}
	$cls = '';
	if( 'checked' === $this->linkenable['isButtonEnabled'] ){
		$cls = "enableicon";
	}
?>
<script>
    var otCcpaScript = document.createElement('script'),
    script1 = document.getElementsByTagName('script')[0];
    otCcpaScript.src = 'https://cookie-cdn.cookiepro.com/ccpa-optout-solution/v1/ccpa-optout.js';
    otCcpaScript.async = true;
    otCcpaScript.type = 'text/javascript';
    script1.parentNode.insertBefore(otCcpaScript, script1);
    otCcpaData = {
		isButtonEnabled: <?php echo wp_json_encode( $this->linkenable['isButtonEnabled'] ); ?>,
		isLinkEnabled: <?php echo wp_json_encode( $this->linkenable['isLinkEnabled'] ); ?>,
		headerBackgroundcolor: <?php echo wp_json_encode( $this->banner_settings['headerBackgroundcolor'] ); ?>,
		headerTextcolor: <?php echo wp_json_encode( $this->banner_settings['headerTextcolor'] ); ?>,
		buttonBackgroundColor: <?php echo wp_json_encode( $this->banner_settings['buttonBackgroundColor'] ); ?>,
		buttonTextColor: <?php echo wp_json_encode( $this->banner_settings['buttonTextColor'] ); ?>,
		popup_main_title: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['popup_main_title'] ) ); ?>,
		// Policy Settings
		PrivacyPolicyMessage: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['PrivacyPolicyMessage'] ) ); ?>,
		linkURL: <?php echo wp_json_encode( $this->behavior_settings['linkURL'] ); ?>,
		linkText: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['linkText'] ) ); ?>,
		// Email Settings
		isEmailEnabled: <?php echo esc_html( $emailenable ); ?>,
		emailAddress: <?php echo wp_json_encode( $this->behavior_settings['emailAddress'] ); ?>,
		// Phone Settings
		isPhoneEnabled: <?php echo esc_html( $phoneenable ); ?>,
		phoneNumber: <?php echo wp_json_encode( $this->behavior_settings['phoneNumber'] ); ?>,
		// Form Link settings
		form_enable: <?php echo esc_html( $formenable ); ?>,
		form_link_text: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['form_link_text'] ) ); ?>,
		form_link_url: <?php echo wp_json_encode( $this->behavior_settings['form_link_url'] ); ?>,
		// GooglePersonalize settings
		isGooglePersonalizeEnabled: <?php echo wp_json_encode( $isGooglePersonalizeEnabled ); ?>,
		googleConfirmationTitle: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['googleConfirmationTitle'] ) ); ?>,
		googleConfirmationMessage: <?php echo wp_json_encode( stripslashes( $this->behavior_settings['googleConfirmationMessage'] ) ); ?>,
		confirmbutton: <?php echo wp_json_encode( $this->behavior_settings['confirmbutton'] ); ?>,
		frameworks: <?php echo wp_json_encode( $frameworks ); ?>,
		isLSPAenable: <?php echo esc_html( $isLSPAenable ); ?>,
		// Display position
		DisplayPosition: <?php echo wp_json_encode( $this->banner_settings['DisplayPosition'] ); ?>,
		location: <?php if( isset( $this->behavior_settings['selectuseroption'] ) ) { echo wp_json_encode( $this->behavior_settings['selectuseroption'] ); } else { echo wp_json_encode( "All" ); } ?>
    }
    window.otccpaooSettings = {
	    layout: {
		    dialogueLocation: otCcpaData.DisplayPosition,
		    primaryColor: otCcpaData.headerBackgroundcolor,
		    secondaryColor: otCcpaData.headerTextcolor,
            button: {
                primary: otCcpaData.buttonBackgroundColor,
                secondary: otCcpaData.buttonTextColor,
            }		    
	    },
	    dialogue: {
			email: {
			    display: otCcpaData.isEmailEnabled,
			    title: otCcpaData.emailAddress,
			    url: "mailto:" + otCcpaData.emailAddress,
		    },
            lspa: {
                accepted: otCcpaData.isLSPAenable,
            },
            phone: {
                display: otCcpaData.isPhoneEnabled,
                title: otCcpaData.phoneNumber,
                url: "tel:" + otCcpaData.phoneNumber,
            },            		    
		    dsar: {
			    display: otCcpaData.form_enable,
			    title: otCcpaData.form_link_text,
			    url: otCcpaData.form_link_url,
		    },
		    intro: {
			    title: otCcpaData.popup_main_title,
			    description: otCcpaData.PrivacyPolicyMessage,
		    },
		    privacyPolicy: {
			    title: otCcpaData.linkText,
			    url: otCcpaData.linkURL,
		    },
		    optOut: {
			    title: otCcpaData.googleConfirmationTitle,
			    description: otCcpaData.googleConfirmationMessage,
			    frameworks: [otCcpaData.frameworks, otCcpaData.isGooglePersonalizeEnabled],
		    },
		    location: otCcpaData.location,
		    confirmation: {
			    text: otCcpaData.confirmbutton,
		    },
	    }
    }; 
</script>
<?php if( 'checked' === $this->linkenable['isButtonEnabled'] ){ ?>
<style>#ot-ccpa-banner{ display:block; }</style>	
<?php } ?>
<div id="ot-ccpa-banner" class="<?php echo esc_attr( $class ); ?>" style="display:none;" data-ot-ccpa-opt-out="buttonicon">
	<?php
		$bg_url = esc_url( $this->plugin->url )."assets/images/icon.png";
	if ( ! empty( $this->banner_settings['otLogo'] ) ) {
		$bg_url = $this->banner_settings['otLogo'];
	}
	?>
	<div class="ot-ccpa-icon <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $cls ); ?>" style="display:<?php echo esc_attr( 'checked' === $this->linkenable['isButtonEnabled'] ? 'flex' : 'none' ); ?>;background-color: <?php echo $this->banner_settings['headerBackgroundcolor']; ?>">
		<a href="javascript:void(0);"><img src="<?php echo esc_url( $bg_url ); ?>" alt="Popup Button" title="CookiePro Do Not Sell"/></a>
	</div>
</div>