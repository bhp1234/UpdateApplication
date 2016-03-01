/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = 'Full';
 
config.toolbar_Full =
[
	{ name: 'document', items : [ 'Preview' ] },
	{ name: 'clipboard', items : [ 'Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace' ]},
	{ name: 'forms', items : [  ] },
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	{ name: 'links', items : [ 'Link'] },
	{ name: 'insert', items : [ 'Image','Flash','Table','Smiley','SpecialChar','PageBreak' ] },

	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize' ] }
];
 
		config.baseFloatZIndex = 11000;
		config.removePlugins = 'elementspath';
	

};
