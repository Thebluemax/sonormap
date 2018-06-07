<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/**
	 * Function Name
	 *
	 * Function description
	 *
	 * @access	public
	 * @param	type	name
	 * @return	type
	 */

	if (! function_exists('alert_helper'))
	{
		function alert_helper($msj = '',$type='')
		{
			$alertType
			switch ($type) {
				case 'info':
						$alertType = 'alert-info'
					break;
				case 'warning':
						$alertType = 'alert-warning';
					break;
				case 'success':
						$alertType = 'alert-success';
					break;
				case 'danger':
						$alertType = 'alert-danger';
					break;
				case 'primary':
						$alertType = 'alert-primary';
					break;
				case 'secondary':
						$alertType = 'alert-secondary';
					break;
				default:
						$alertType = 'alert-default';
						$type = 'default';
					break;
			}
			$alerTemplate = '<div class="alert '.$alertType.'"><button type="button" class="close" data-dismiss="'.$type.'" aria-hidden="true">&times;</button>'.
			$msj.'</div>';

			return $alertTemplate;
		}
	}