/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.extraPlugins='video';
	config.extraPlugins='video,jwplayer';
	
	config.toolbar = 'Full';
	config.toolbar_Full =
	[
		['Source','Bold','Italic','Underline'],		//['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],		//['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],		//['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],		'/',		//['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],		//['Bold','Italic','Underline'],				//['Bold','Italic','Underline','NumberedList','BulletedList','Blockquote','Image','Source','Link','Unlink','Anchor'],		//['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],		['NumberedList','BulletedList','Blockquote'],				//['NumberedList','BulletedList','Blockquote','Image'],		//['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],		//['BidiLtr', 'BidiRtl'],		['Link'],		//['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','Video','jwplayer'],		['Image'],		'/',		//['Styles','Format','Font','FontSize'],		//['TextColor','BGColor'],		//['Maximize','ShowBlocks','-','About']
	];
	 
	config.toolbar_Basic =
	[
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
	];
};
