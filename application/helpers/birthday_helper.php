<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('add_select_day'))
{
    function add_select_day($value=FALSE)
    {    $days = array();
    	for ($val=1; $val<=31;$val++) {
    		# code...
    		$day=(string)$val;
    		$days[$day]=$val;
    	}
    	$months = array( 1=>'gener' ,
    					 2=>'febrer',
    					 3=>'març',
    					 4=>'abril',
    					 5=>'maig',
    					 6=>'juny',
    					 7=>'juliol',
    					 8=>'agost',
    					 9=>'setembre',
    					 10=>'octubre',
    					 11=>'novembre',
    					 12=>'desembre' 
    					);
    	$years=array();
    	$this_year=date('Y',time());
    	$top_age=$this_year-18;

    	for ($val=$top_age; $val>=$this_year-100;$val--) {
    		# code...
    		$year=(string)$val;
    		$years[$year]=$val;
    	}

        $CI =& get_instance();
        
        $CI->load->helper('form');  
        $day='';
        $month='';
        $year_s='';
         if($value!==FALSE){
             $selected=explode('-',$value);
             $day=$selected[2];
             $month=$selected[1];
             $year_s=$selected[0];
         }
         $class='class="form-control"';
        $select=form_dropdown("dia",$days,$day,$class);
          $select.=form_dropdown("mes",$months,$month,$class);
            $select.=form_dropdown("anio",$years,$year_s,$class);
        return $select;

    }
}
    if ( ! function_exists('add_day_select'))
{
 function add_day_select()
    {
       $days = array();
        for ($val=1; $val<=31;$val++) {
            # code...
            $day=(string)$val;
            $days[$day]=$val;
        }
        $months = array( 1=>'gener' ,
                         2=>'febrer',
                         3=>'març',
                         4=>'abril',
                         5=>'maig',
                         6=>'juny',
                         7=>'juliol',
                         8=>'agost',
                         9=>'setembre',
                         10=>'octubre',
                         11=>'novembre',
                         12=>'desembre' 
                        );
    
    $years=array();
        $this_year=date('Y',time());
        $top_age=$this_year-18;

        for ($val=$this_year; $val>=2012;$val--) {
            # code...
            $year=(string)$val;
            $years[$year]=$val;
        }
             $day="1";
             $month="2";
             $year_s="2014";
        $CI =& get_instance();
        $CI->load->helper('form');  
         $class='class="form-control"';
        $select=form_dropdown("dia",$days,$day,$class);
          $select.=form_dropdown("mes",$months,$month,$class);
            $select.=form_dropdown("anio",$years,$year_s,$class);
        return $select;
}
}
/* End of birthday_helper.php */
/* Location: ./application/helpers/birthday_helper.php */