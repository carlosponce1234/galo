/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'galo\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-home': '&#xe900;',
		'icon-folder-open': '&#xe930;',
		'icon-floppy-disk': '&#xe962;',
		'icon-user': '&#xe971;',
		'icon-users': '&#xe972;',
		'icon-user-plus': '&#xe973;',
		'icon-user-minus': '&#xe974;',
		'icon-user-tie': '&#xe976;',
		'icon-binoculars': '&#xe985;',
		'icon-search': '&#xe986;',
		'icon-key': '&#xe98d;',
		'icon-key2': '&#xe98e;',
		'icon-lock': '&#xe98f;',
		'icon-unlocked': '&#xe990;',
		'icon-cog': '&#xe994;',
		'icon-bin': '&#xe9ac;',
		'icon-cloud-download': '&#xe9c2;',
		'icon-cloud-upload': '&#xe9c3;',
		'icon-download2': '&#xe9c5;',
		'icon-upload2': '&#xe9c6;',
		'icon-eye': '&#xe9ce;',
		'icon-blocked': '&#xea0e;',
		'icon-cross': '&#xea0f;',
		'icon-checkmark': '&#xea10;',
		'icon-enter': '&#xea13;',
		'icon-sort-alpha-asc': '&#xea48;',
		'icon-sort-alpha-desc': '&#xea49;',
		'icon-checkbox-checked': '&#xea52;',
		'icon-checkbox-unchecked': '&#xea53;',
		'icon-file-pdf': '&#xeadf;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
