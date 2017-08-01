<?php 
/****************************************/

  function getInventoryPages($pages)
  {
	  $output ='';
	  $output .='<a href="" class="nextPreviousPaginationPrev">Prev</a>';
	  
	  if(count($pages) > 1)
	  for($i=1; $i <= $pages; $i++)
	  {
		$cls= $i==1? 'nextPreviousPaginationActive' : '';  
        $output .='<a longdesc="0" href="" class="nextPreviousPagination '.$cls.'">'.$i.'</a>';
	  }
      $output .='<a href="" class="nextPreviousPaginationNext">Next</a>';
      return $output;
  }


/****************************************/ 

?>