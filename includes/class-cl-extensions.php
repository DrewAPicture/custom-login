<?php
/**
 * @package     CustomLogin
 * @subpackage  Classes/CL_Extensions
 * @author      Austin Passy <http://austin.passy.co>
 * @copyright   Copyright (c) 2014, Austin Passy
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class CL_Extensions {
	
	var	$extensions = array(),
		$checkout_url = '';
	
	public function __construct() {
		$this->checkout_url = CUSTOM_LOGIN_API_URL . 'checkout/';
		$this->get_extensions();
	}
	
	private function get_extensions() {
		
		$transient_key	= CL_Common::get_transient_key( 'extensions' );
		$extensions	= CL_Common::wp_remote_get( false, $transient_key );
		
		if ( $extensions ) {
			$this->extensions[] = $extensions;
		}
		else {
			/* Stealth Login */
			$this->extensions[] = array(
				'title'			=> 'Custom Login Stealth Login',
				'description'	=> 'Protect your wp-login.php page from brute force attacks.',
				'url'			=> 'https://frosty.media/plugins/custom-login-stealth-login/',
				'image'			=> 'https://i.imgur.com/mhuymPG.jpg',
				'links'			=> array(
					array( 
						'description'	=> 'Personal',
						'download_id'	=> '108',
						'price_id'		=> '0',
						'price'			=> '$35',
					),
					array( 
						'description'	=> 'Plus',
						'download_id'	=> '108',
						'price_id'		=> '1',
						'price'			=> '$95',
					),
					array( 
						'description'	=> 'Professional',
						'download_id'	=> '108',
						'price_id'		=> '2',
						'price'			=> '$195',
					),
				),
			);
			
			/* Page Template */
			$this->extensions[] = array(
				'title'			=> 'Custom Login Page Template',
				'description'	=> 'Add a login form to any WordPress page.',
				'url'			=> 'https://frosty.media/plugins/custom-login-page-template/',
				'image'			=> 'https://i.imgur.com/A0rzS9q.jpg',
				'links'			=> array(
					array( 
						'description'	=> 'Personal',
						'download_id'	=> '120',
						'price_id'		=> '0',
						'price'			=> '$35',
					),
					array( 
						'description'	=> 'Plus',
						'download_id'	=> '120',
						'price_id'		=> '1',
						'price'			=> '$95',
					),
					array( 
						'description'	=> 'Professional',
						'download_id'	=> '120',
						'price_id'		=> '2',
						'price'			=> '$195',
					),
				),
			);
			
			/* Login Redirects */
			$this->extensions[] = array(
				'title'			=> 'Custom Login Redirects',
				'description'	=> 'Manage redirects after logging in.',
				'url'			=> 'https://extendd.com/plugin/wordpress-login-redirects/',
				'image'			=> 'https://i.imgur.com/aNGoyAa.jpg',
				'links'			=> array(
					array( 
						'description'	=> 'Personal',
						'download_id'	=> '124',
						'price_id'		=> '0',
						'price'			=> '$35',
					),
					array( 
						'description'	=> 'Plus',
						'download_id'	=> '124',
						'price_id'		=> '1',
						'price'			=> '$95',
					),
					array( 
						'description'	=> 'Professional',
						'download_id'	=> '124',
						'price_id'		=> '2',
						'price'			=> '$195',
					),
				),
			);
			
			/* No Password */
			$this->extensions[] = array(
				'title'			=> 'Custom Login No Password',
				'description'	=> 'Allow users to login without a password.',
				'url'			=> 'https://frosty.media/plugins/custom-login-no-passowrd-login/',
				'image'			=> 'https://i.imgur.com/7SXIpi5.jpg',
				'links'			=> array(
					array( 
						'description'	=> 'Personal',
						'download_id'	=> '128',
						'price_id'		=> '0',
						'price'			=> '$35',
					),
					array( 
						'description'	=> 'Plus',
						'download_id'	=> '128',
						'price_id'		=> '1',
						'price'			=> '$95',
					),
					array( 
						'description'	=> 'Professional',
						'download_id'	=> '128',
						'price_id'		=> '2',
						'price'			=> '$195',
					),
				),
			);
			
		} // if
	}
	
	public function html() {
		
		$html = '<div class="section">';
		
		foreach( $this->extensions as $key => $extension ) {
			$html .= '<div class="col span_1_of_3 eddri-addon">';			
				$html .= '<div class="eddri-addon-container">';
					$html .= '<div class="eddri-img-wrap">';					
						$html .= '<a href="' . add_query_arg( array( 'utm_source' => 'wordpressorg', 'utm_medium' => 'custom-login', 'utm_campaign' => 'eddri' ), $extension['url'] ) . '" target="_blank"><img class="eddri-thumbnail" src="' . $extension['image'] . '"></a>';						
						$html .= '<p>' . $extension['description'] . '</p>';						
					$html .= '</div>';
					
					$html .= '<h3>' . $extension['title'] . '</h3>';
					$html .= '<span class="eddri-status">Not Installed</span>';
					$html .= '<a class="button" data-edd-install="' . $extension['title'] . '">Install</a>';
					$html .= '<a class="button show-if-not-purchased" data-toggle="purchase-links-' . $key . '" style="display:none">Purchase License</a>';
					$html .= '<div id="purchase-links-1" style="display:none">';
					
						$html .= '<ul>';						
						foreach( $extension['links'] as $link ) {
							$html .= '<li><a href="' . add_query_arg( array( 'edd_action' => 'straight_to_gateway', 'download_id' => $link['download_id'], 'edd_options[price_id]' => $link['price_id'] ), $this->checkout_url ) . '">' . $link['description'] . '(' . $link['price'] . ')</a></li>';
						}						
						$html .= '</ul>';
						
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		} // foreach
		
		$html .= '</div>';
		
		echo $html;
	}
	
}