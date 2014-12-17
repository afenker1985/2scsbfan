<?php

/**
 * Captcha
 *
 * Captcha is based Drew Phillips' Securimage script ({@link http://www.neoprogrammers.com}).
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA	02110-1301, USA.
 *
 * @package		Captcha
 * @author		Erich Musick <mail@erichmusick.com>
 * @author		Stan Lemon <stosh1985@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @version		Release: 1.1.0
 * @link 		http://erichmusick.com
 * @link 		http://stanlemon.net/projects/captcha
 */
class Captcha {

	/**
     * CAPTCHA Code
     *
     * Variable for storing the generated CAPTCHA code
     *
     * @var     string
     * @access  private
     */
	protected $code;

	/**
     * CAPTCHA Image
     *
     * @var     string
     * @access  private
     */
	protected $image;
	
	/**
	 * Image Types
	 *
	 * @var 	array
	 * @access 	protected
	 */
	protected $types = array(
		"jpg" 		=> IMG_JPG,
		"jpeg"		=> IMG_JPG,
		"png" 		=> IMG_PNG,
		"gif" 		=> IMG_GIF,
		"xpm" 		=> IMG_XPM,
		"wbmp" 		=> IMG_WBMP 
	);
	
	/**
     * Default Options
     *
     * @var     bool
     * @access  private
     */
	public static $__options = array(
		"width" 						=> 260,
		"height" 						=> 40,
		"length" 						=> 8,
		"font_path" 					=> "./VeraSe.ttf",
		"font_size" 					=> 20,
		"text_angle_minimum" 			=> -25,
		"text_angle_maximum" 			=> 25,
		"text_x_start" 					=> 9,
		"text_minimum_distance" 		=> 30,
		"text_maximum_distance" 		=> 33,
		"image_bg_color" 				=> array( 220, 220, 255),
		"text_color" 					=> array( 48, 48, 189),
		"shadow_text" 					=> false,
		"use_transparent_text" 			=> true,
		"text_transparency_percentage" 	=> 15,
		"draw_lines" 					=> true,
		"line_color" 					=> array( 143, 143, 222),
		"line_distance" 				=> 17,
		"draw_angled_lines" 			=> true,
		"draw_lines_over_text" 			=> false
	);


	/**
	 * Generate CAPTCHA Code and Image
	 *
	 * @access	public
	 * @see		$_options
	 * @return	bool Whether or not code & image creation was successful
	 */
	public function __construct( $options = array() ) {
		$this->options = array_merge( Captcha::$__options, $options ); // Until 5.3 with LSB we'll do this.
		$this->code = $this->createPronouncablePassword( $this->options['length'] );

		// If a session hasn't been started (highly unlikely!), start one.
		if (session_id() === '') session_start();

		$_SESSION[ __CLASS__ ] = array();
		$_SESSION[ __CLASS__ ]['Code'] = $this->code;
		$_SESSION['code'] = $this->code; // Deprecated, but here for older usages.

		if (!is_readable($this->options['font_path'])) {
			trigger_error("TTF Font file is not readable.");
			return false;
		} else {
			$this->build();
			return true;
		}
	}


	protected function build() {
		if ( $this->options['use_transparent_text'] == true || $this->options['background'] != '') {
			$this->image = imagecreatetruecolor($this->options['width'], $this->options['height']);

			$bgcolor = imagecolorallocate($this->image, $this->options['image_bg_color'][0], $this->options['image_bg_color'][1], $this->options['image_bg_color'][2]);

			imagefilledrectangle($this->image, 0, 0, imagesx($this->image), imagesy($this->image), $bgcolor);
		} else {
			$this->image = imagecreate($this->options['width'], $this->options['height']);

			$bgcolor = imagecolorallocate($this->image, $this->options['image_bg_color'][0], $this->options['image_bg_color'][1], $this->options['image_bg_color'][2]);
		}

		if (isset($this->options['background']) && !empty($this->options['background']))
			$this->setBackground();

		if (isset($this->options['draw_lines_over_text']) && !$this->options['draw_lines_over_text'] && isset($this->options['draw_lines']) && $this->options['draw_lines'])
			$this->drawLines();

		$this->drawWord();

		if (isset($this->options['draw_lines_over_text']) && $this->options['draw_lines_over_text'] && isset($this->options['draw_lines']) && $this->options['draw_lines'])
			$this->drawLines();
	}


	protected function setBackground() {
		if ( ($dat = @getimagesize($this->options['background'])) === false ) {
			trigger_error("Unable to get the size of the background image.");
			return false;
		} else {
			switch($dat[2]) {
				case 1: 
					$new = @imagecreatefromgif($this->options['background']); break;
				case 2: 
					$new = @imagecreatefromjpeg($this->options['background']); break;
				case 3: 
					$new = @imagecreatefrompng($this->options['background']); break;
				case 15: 
					$new = @imagecreatefromwbmp($this->options['background']); break;
				case 16: 
					$new = @imagecreatefromxbm($this->options['background']); break;
				default: 
					return false;
			}

			if( $newim === false ) {
				trigger_error("Unable to create an image from the background image file.");
				return false;
			} else {
				imagecopy($this->image, $new, 0, 0, 0, 0, $this->options['width'], $this->options['height']);
				return true;
			}
		}
	}


	protected function drawLines() {
		$linecolor = imagecolorallocate($this->image, $this->options['line_color'][0], $this->options['line_color'][1], $this->options['line_color'][2]);

		for($x = 1; $x < $this->options['width']; $x += $this->options['line_distance'])
			imageline($this->image, $x, 0, $x, $this->options['height'], $linecolor);

		for($y = 11; $y < $this->options['height']; $y += $this->options['line_distance'])
			imageline($this->image, 0, $y, $this->options['width'], $y, $linecolor);

		if ($this->options['draw_angled_lines'] === true) {
			for ($x = -($this->options['height']); $x < $this->options['width']; $x += $this->options['line_distance'])
				imageline($this->image, $x, 0, $x + $this->options['height'], $this->options['height'], $linecolor);

			for ($x = $this->options['width'] + $this->options['height']; $x > 0; $x -= $this->options['line_distance'])
				imageline($this->image, $x, 0, $x - $this->options['height'], $this->options['height'], $linecolor);
		}
	}


	protected function drawWord() {
		if ($this->options['use_transparent_text'] === true) {
			$alpha = floor($this->options['text_transparency_percentage'] / 100 * 127);
			$font_color = imagecolorallocatealpha($this->image, $this->options['text_color'][0], $this->options['text_color'][1], $this->options['text_color'][2], $alpha);
		} else {
			$font_color = imagecolorallocate($this->image, $this->options['text_color'][0], $this->options['text_color'][1], $this->options['text_color'][2]);
		}

		$x = $this->options['text_x_start'];

		$strlen = strlen($this->code);

		$y_min = ($this->options['height'] / 2) + ($this->options['font_size'] / 2) - 2;
		$y_max = ($this->options['height'] / 2) + ($this->options['font_size'] / 2) + 2;

		for($i = 0; $i < $strlen; ++$i) {
			$angle = rand($this->options['text_angle_minimum'], $this->options['text_angle_maximum']);

			$y = rand($y_min, $y_max);

			imagettftext($this->image, $this->options['font_size'], $angle, $x, $y, $font_color, $this->options['font_path'], $this->code{$i});

			if ($this->options['shadow_text'] === true) {
				imagettftext($this->image, $this->options['font_size'], $angle, $x + 2, $y + 2, $font_color, $this->options['font_path'], $this->code{$i});
			}

			$x += rand($this->options['text_minimum_distance'], $this->options['text_maximum_distance']);
		}
	}


	/**
	 * Get Code
	 *
	 * Get the generated CAPTCHA code
	 *
	 * @see		$_code
	 * @access	public
	 * @since	1.0.0
	 * @return	string	$this->code The generated CAPTCHA code
	 */
	public function getCode() {
		return $this->code;
	}


	/**
	 * Get Image
	 *
	 * Get the CAPTCHA image in the specified format. Currently, the formats supported are
	 * png, jpeg, gif, xbm, and wbmp
	 *
	 * @param  string $type Image format to return. Possible values: png, jpg, jpeg, gif, xbm, wbmp
	 * @access	public
	 * @since	1.0.0
	 * @return	void
	 */
	public function getImage( $type = "png") {
		if ( !isset($this->types[ strtolower($type) ]) && (imagetypes() & $this->types[ strtolower($type) ]) ) {
			trigger_error("Invalid image type specified. There is no support for images of type $type");
			return false;
		} else {
			$success = false;

			ob_start();

			switch ( strtolower($type) ) {
				case 'png':
					$success = imagepng( $this->image );
					break;
				case 'jpg':
					$success = imagejpeg( $this->image );
					break;
				case 'gif':
					$success = imagegif( $this->image );
					break;
				case 'xbm':
					$success = imagexbm( $this->image , null );
					break;
				case 'wbmp':
					$success = imagewbmp( $this->image );
					break;
			}

			$image = ob_get_clean();

			if ($success === false) {
				trigger_error("Unable to export image to specified type.");
				return false;
			} else {
				return $image;
			}
		}
	}


	protected function output( $type = 'png' ) {
		if ( ($output = $this->getImage( $type )) === false ) {
			return false;
		} else {
			$contentType = "";

			switch ($type) {
				case 'png':
					$contentType = "image/x-png";
				case 'jpg':
					$contentType = "image/jpeg";
				case 'gif':
					$contentType = "image/gif";
				case 'xbm':
					$contentType = "image/x-xbitmap";
				case 'wbmp':
					$contentType = "image/vnd.wap.wbmp";
				default:
			}

			header("Expires: Sun, 1 Jan 2000 12:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header("Content-type: $contentType");

			print $output;

			return true;
		}
	}

	/**
	* Create pronounceable password
	*
	* This method creates a string that consists of
	* vowels and consonats.
	*
	* Borrowed from PEAR::Text_Password class, available
	* at {@link http://pear.php.net/package/Text_Password }
	*
	* @access private
	* @param	integer Length of the password
	* @return string	Returns the password
	*/
	protected function createPronouncablePassword($length) {
		$retVal = '';

		$vowels = array('a', 'e', 'i', 'o', 'u', 'ae', 'ou', 'io', 'ea', 'ou', 'ia', 'ai' );
		$consonants = array(	'b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'u', 'v', 'w','tr', 'cr', 'fr', 'dr', 'wr', 'pr', 'th','ch', 'ph', 'st', 'sl', 'cl');

		$v_count = 12;
		$c_count = 29;

		for ($i = 0; $i < $length; $i++) {
			$retVal .= $consonants[mt_rand(0, $c_count-1)] . $vowels[mt_rand(0, $v_count-1)];
		}

		return substr($retVal, 0, $length);
	}
	
	
	public function __toString() {
		$this->output();
		exit;
	}
}

?>
