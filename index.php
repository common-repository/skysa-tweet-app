<?php
/*
Plugin Name: Skysa Tweet App
Plugin URI: http://wordpress.org/extend/plugins/skysa-tweet-app
Description: Let people share content on Twitter without having to leave the page.
Version: 1.4
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                 This app was made using the:              *
*                       Skysa App SDK                       *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


// Tweet APP
$GLOBALS['SkysaApps']->RegisterApp(array( 
    'id' => '50206822d09b4',
    'label' => 'Tweet',
	'options' => array(
        'data' => array(
            'label' => 'Tweet Message Text',
			'info' => 'What text would you like included in Tweets shared through this button? (Leave this blank to tweet your the page title.)',
			'type' => 'textarea',
			'value' => '',
			'size' => '40|5'
		),
		'option3' => array(
            'label' => 'What URL would you like shared?',
			'info' => 'Leave this blank to share the page URL the user is currently on.',
			'type' => 'text',
			'value' => '',
			'size' => '50|1'
		),
		'title' => array(
            'label' => 'Twitter Promote Account',
			'info' => 'What is a twitter account you wish to promote in the tweet? (optional)',
			'type' => 'text',
			'value' => '',
			'size' => '40|1'
		),
        'option2' => array(
            'label' => 'Show Tweet Count?',
			'info' => 'Show the number count next to the Tweet button?',
			'type' => 'selectbox',
			'value' => 'Yes|No',
			'size' => '10|1'
		)
	), 
    'fvars' => array(
        'count' => 'skysa_app_tweet_fvar_count'
    ),
    'html' => '<div id="$button_id" class="SKYUI-Mod-Tweet-Button-holder"><span class="SKYUI-Mod-Tweet-Button"><a href="http://twitter.com/share" class="twitter-share-button" data-url="$app_option3" data-text="$app_data" data-count="#fvar_count" data-via="$app_title"></a></span></div>',
    'js' => "
        S.on('load',function(){
            S.require('js','//platform.twitter.com/widgets.js');
        });
        S.load('cssStr','.SKYUI-Mod-Tweet-Button-holder {width: '+('\$app_option2' != 'No' ? '116' : '63')+'px !important;} .SKYUI-Mod-Tweet-Button iframe, .SKYUI-Mod-Tweet-Button a {margin: 5px 3px 0 3px} .SKYUI-Mod-Tweet-Button a { display: inline-block; min-width: 55px; height: 20px; line-height: 20px;}',true);
     "
));

function skysa_app_tweet_fvar_count($rec){
    if($rec['option2'] != 'No'){
        return 'horizontal';
    }
    return 'none';
}
?>