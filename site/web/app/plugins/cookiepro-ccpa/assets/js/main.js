/**
 * Script content decleared hear
 *
 * @package CookieProCCPA
 */

jQuery( document ).ready(
	function($){
		$( "#ot-CCPA-button-text-color-picker" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-button-text-color-picker" ).val();
				$( "#ot-CCPA-button-text-box" ).val( color );
			}
		);

		$( "#ot-CCPA-button-text-box" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-button-text-box" ).val();
				$( "#ot-CCPA-button-text-color-picker" ).val( color );
			}
		);

		$( "#ot-CCPA-button-background-color-picker" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-button-background-color-picker" ).val();
				$( "#ot-CCPA-button-background-text-box" ).val( color );
			}
		);

		$( "#ot-CCPA-button-background-text-box" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-button-background-text-box" ).val();
				$( "#ot-CCPA-button-background-color-picker" ).val( color );
			}
		);
		// Header color change.
		$( "#ot-CCPA-header-text-color-picker" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-header-text-color-picker" ).val();
				$( "#ot-CCPA-header-text-box" ).val( color );
			}
		);

		$( "#ot-CCPA-header-text-box" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-header-text-box" ).val();
				$( "#ot-CCPA-header-text-color-picker" ).val( color );
			}
		);

		$( "#ot-CCPA-header-background-color-picker" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-header-background-color-picker" ).val();
				$( "#ot-CCPA-header-background-text-box" ).val( color );
			}
		);

		$( "#ot-CCPA-header-background-text-box" ).on(
			'change',
			function(){
				var color = $( "#ot-CCPA-header-background-text-box" ).val();
				$( "#ot-CCPA-header-background-color-picker" ).val( color );
			}
		);

		$( "#ot-ccpa-snippet-button" ).on(
			{
				"click": function(e) {
					var copyText = document.getElementById( "ot-ccpa-snippet-text" );
					copyText.select();
					document.execCommand( "copy" );
					var x = this.getBoundingClientRect();
					$( '#tooltipDiv' ).html( "Link Copied" );
					$( '#tooltipDiv' ).css( {"top":x.top - 45, "left": x.left, "display": "block"} );
				},
				"mouseout": function() {
					$( '#tooltipDiv' ).css( "display","none" );
				}
			}
		);
		$( "#ot-ccpa-optout-button" ).on(
			{
				"click": function(e) {
					var copyText2 = document.getElementById( "ot-ccpa-optout-text" );
					copyText2.select();
					document.execCommand( "copy" );
					var x = this.getBoundingClientRect();
					$( '#optouttooltipDiv' ).html( "Link Copied" );
					$( '#optouttooltipDiv' ).css( {"top":x.top - 45, "left": x.left, "display": "block"} );
				},
				"mouseout": function() {
					$( '#optouttooltipDiv' ).css( "display","none" );
				}
			}
		);
		$("#floatingbutton").click(
			function(){
				if ( $( '#floatingbutton' ).is( ':checked' ) ) {
					$(".floating_button_enable").slideDown();
				} else {
					$(".floating_button_enable").slideUp();
				}				
			}
		);
		if ( $( '#floatingbutton' ).is( ':checked' ) ) {
			$( '.floating_button_enable' ).css( 'display','flex' );
		}
		// enable text box.
		$("input[name$='isLinkEnabled']").click(function() {
	        var inputval = $(this).val();
	        $("div.textboxsnippet").hide();
	        $("#" + inputval).slideDown();
	    });		

		var radioValue = $("input[name='isLinkEnabled']:checked").val();
        if(radioValue){
        	$("#" + radioValue).show();
        }
		// isGooglePersonalizeEnabled.
		$( '#isGooglePersonalizeEnabled' ).click(
			function(){
				if ( $( '#isGooglePersonalizeEnabled' ).is( ':checked' ) ) {
					$( '#iabccpa, .GooglePersonalize' ).slideDown();
					$( '#laspoption' ).slideDown();
				} else {
					$( '#iabccpa, .GooglePersonalize' ).slideUp();
					$( '#laspoption' ).slideUp();
				}
			}
		);
		if ( $( '#isGooglePersonalizeEnabled' ).is( ':checked' ) ) {
			$( '#iabccpa' ).css( 'display','flex' );
		} else {
			$( '#iabccpa, .GooglePersonalize' ).css( 'display','none' );
			$( '#laspoption' ).css( 'display','none' );
		}

		// LSPA enable.
		$( '#isIABEnabled' ).click(
			function(){
				if ( $( '#isIABEnabled' ).is( ':checked' ) ) {
					$( '#laspoption' ).slideDown();
				} else {
					$( '#laspoption' ).slideUp();
				}
			}
		);
		if ( $( '#isIABEnabled' ).is( ':checked' ) && $( '#isGooglePersonalizeEnabled' ).is( ':checked' ) ) {
			$( '#laspoption' ).css( 'display','flex' );
		} else {
			$( '#laspoption' ).css( 'display','none' );
		}
		// isEmailEnabled.
		$( '#isEmailEnabled' ).click(
			function(){
				if ( $( '#isEmailEnabled' ).is( ':checked' ) ) {
					$(".EmailEnabled").slideDown();
				} else {
					$(".EmailEnabled").slideUp();
				}
			}
		);
		if ( $( '#isEmailEnabled' ).is( ':not(:checked)' ) ) {
			$(".EmailEnabled").css('display','none');
		}

		// isPhoneEnabled.
		$( '#isPhoneEnabled' ).click(
			function(){
				if ( $( '#isPhoneEnabled' ).is( ':checked' ) ) {
					$('.PhoneEnabled').slideDown();
				} else {
					$('.PhoneEnabled').slideUp();
				}
			}
		);
		if ( $( '#isPhoneEnabled' ).is( ':not(:checked)' ) ) {
			$('.PhoneEnabled').css('display','none');
		}

		// Request Form.
		$( '#form_enable' ).click(
			function(){
				if ( $( '#form_enable' ).is( ':checked' ) ) {
					$('.FormEnabled').slideDown();
				} else {
					$('.FormEnabled').slideUp();
				}
			}
		);
		if ( $( '#form_enable' ).is( ':not(:checked)' ) ) {
			$('.FormEnabled').css('display', 'none');
		}

		$( '#ConfirmationEnabled' ).click(
			function(){
				if ( $( this ).is( ':checked' ) ) {
					$( '#PersonalInfoToggle' ).val( 'on' );
				} else {
					$( '#PersonalInfoToggle' ).val( 'off' );
				}
			}
		);

	}
);
