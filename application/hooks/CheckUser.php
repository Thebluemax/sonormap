<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckUser {
	private $CI;
	function __construct()
	{
        $this->CI =& get_instance();
    }
	public function userLog ()
	{
		if ($this->CI->_securePage===TRUE)
		{
			if ($this->CI->_security!=TRUE )
			{
				if (!$this->CI->session->flashdata('error_login'))
				{
					$this->CI->session->set_flashdata('error_login',$this->CI->session->flashdata('error_login')+1);
				} else
				{
					$this->CI->session->set_flashdata('error_login',1);
				}

				redirect('login');
			}

		}

	}

}

/* End of file CheckUser.php */
/* Location: ./application/hooks/CheckUser.php */