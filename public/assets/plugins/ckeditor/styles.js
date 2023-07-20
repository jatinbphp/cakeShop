/**
 * Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

// This file contains style definitions that can be used by CKEditor plugins.
//
// The most common use for it is the "stylescombo" plugin, which shows a combo
// in the editor toolbar, containing all styles. Other plugins instead, like
// the div plugin, use a subset of the styles on their feature.
//
// If you don't have plugins that depend on this file, you can simply ignore it.
// Otherwise it is strongly recommended to customize this file to match your
// website requirements and design properly.

CKEDITOR.stylesSet.add( 'default',
[
	/* Block Styles */

	// These styles are already available in the "Format" combo, so they are
	// not needed here by default. You may enable them to avoid placing the
	// "Format" combo in the toolbar, maintaining the same features.
	/*
	{ name : 'Paragraph'		, element : 'p' },
	{ name : 'Heading 1'		, element : 'h1' },
	{ name : 'Heading 2'		, element : 'h2' },
	{ name : 'Heading 3'		, element : 'h3' },
	{ name : 'Heading 4'		, element : 'h4' },
	{ name : 'Heading 5'		, element : 'h5' },
	{ name : 'Heading 6'		, element : 'h6' },
	{ name : 'Preformatted Text', element : 'pre' },
	{ name : 'Address'			, element : 'address' },
	*/
	
	{ name : 'HEADER'				, element : 'span', styles : { 'color' : '#860309',
															   'text-transform' : 'uppercase',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '22px' } },
	{ name : 'Body1'				, element : 'span', styles : { 'color' : '#414042',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '12px' } },
	{ name : 'Body3'				, element : 'span', styles : { 'color' : '#860309',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '12px' } },
	{ name : 'Body2'				, element : 'span', styles : { 'color' : '#414042',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '12px',
															   'border-bottom':'#a0a0a0 1px solid' } },
	{ name : 'SubHeader'			, element : 'span', styles : { 'color' : '#414042',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '14px',
															   'font-weight':'bold' } },
	{ name : 'LinkClass'			, element : 'span', styles : { 'color' : '#860309',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '12px',
															   'text-decoration':'none' } },
	{ name : 'Link Hover'			, element : 'span', styles : { 'color' : '#860309',
															   'font-family' : 'Arial, Helvetica, sans-serif',
															   'font-size' : '12px',
															   'text-decoration':'none' } },
	/*{ name : 'LinkClass'			, element : 'span', attributes : { 'class': 'my_style' } },
	{ name : 'Link Hover'			, element : 'span', attributes : {'class': 'my_style' } },*/
															   
	

	/* Inline Styles */

	// These are core styles available as toolbar buttons. You may opt enabling
	// some of them in the Styles combo, removing them from the toolbar.
	/*
	{ name : 'Strong'			, element : 'strong', overrides : 'b' },
	{ name : 'Emphasis'			, element : 'em'	, overrides : 'i' },
	{ name : 'Underline'		, element : 'u' },
	{ name : 'Strikethrough'	, element : 'strike' },
	{ name : 'Subscript'		, element : 'sub' },
	{ name : 'Superscript'		, element : 'sup' },
	*/

	{ name : 'Marker: Yellow'	, element : 'span', styles : { 'background-color' : 'Yellow' } },
	{ name : 'Marker: Green'	, element : 'span', styles : { 'background-color' : 'Lime' } },

	{ name : 'Big'				, element : 'big' },
	{ name : 'Small'			, element : 'small' },
	{ name : 'Typewriter'		, element : 'tt' },

	{ name : 'Computer Code'	, element : 'code' },
	{ name : 'Keyboard Phrase'	, element : 'kbd' },
	{ name : 'Sample Text'		, element : 'samp' },
	{ name : 'Variable'			, element : 'var' },

	{ name : 'Deleted Text'		, element : 'del' },
	{ name : 'Inserted Text'	, element : 'ins' },

	{ name : 'Cited Work'		, element : 'cite' },
	{ name : 'Inline Quotation'	, element : 'q' },

	{ name : 'Language: RTL'	, element : 'span', attributes : { 'dir' : 'rtl' } },
	{ name : 'Language: LTR'	, element : 'span', attributes : { 'dir' : 'ltr' } },
	
	{ name : 'Language: RTL Strong'	, element : 'bdo', attributes : { 'dir' : 'rtl' } },
	{ name : 'Language: LTR Strong'	, element : 'bdo', attributes : { 'dir' : 'ltr' } },

	/* Object Styles */

	{
		name : 'Image on Left',
		element : 'img',
		attributes :
		{
			'style' : 'padding: 5px; margin-right: 5px',
			'border' : '2',
			'align' : 'left'
		}
	},	

	{
		name : 'Image on Right',
		element : 'img',
		attributes :
		{
			'style' : 'padding: 5px; margin-left: 5px',
			'border' : '2',
			'align' : 'right'
		}
	},
	
	/*{
		name : 'LinkClass',
		element : 'a',
		attributes :
		{
			'style' : 'color: #339933; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-decoration: none;'
		}
	},
	
	{
		name : 'Link Hover',
		element : 'a',
		attributes :
		{
			'style' : 'color: #339933; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-decoration: none;'
		}
	},*/

	{ name : 'Borderless Table', element : 'table', styles: { 'border-style': 'hidden', 'background-color' : '#E6E6FA' } },
	{ name : 'Square Bulleted List', element : 'ul', styles : { 'list-style-type' : 'square' } }
]);

