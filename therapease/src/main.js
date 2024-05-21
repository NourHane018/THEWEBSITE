

import '../styles/modern-normalize.css'
import '../styles/style.css'
import '../styles/utils.css'
import '../styles/components/header.css'
import '../styles/components/hero.css'
import '../styles/components/About.css'
import '../styles/components/Service.css'
import '../styles/components/Doctor.css'
import '../styles/components/Contact.css'
import '../styles/components/footer.css'
import '../styles/components/mobile_nav.css'
import MobileNav from './utils/mobile_nav'


MobileNav();

$(function() {
	

	"use strict";

	$(".section-contact .content .hire-us button").on("mouseenter", function() {
		$(this).parent().css("backgroundColor","#5dadc4");
		$(this).css({
			"background-color": "#252525",
			"box-shadow": "0 0 5px 0 rgba(0,0,0,.8)"
		});
	});

	$(".section-contact .content .hire-us button").on("mouseleave", function() {
		$(this).parent().css("backgroundColor","#252525");
		$(this).css({
			"background-color": "#5dadc4",
			"box-shadow": "none"
		});
	});

});