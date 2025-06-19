<?php
	include '../models/majax.php';

	$valor = $_REQUEST['valor'];
	$majax = new Majax();
	$datFor = $majax->getFor($valor);
	$det = $datFor[0];

	$html = '<div id="recFormato">';
		$html .= '<div style="text-align: center; margin-top: 20px">';
            $html .= '<u><h5>'.$det['nomval'].'</h5></u>';
        $html .= '</div>';
		for($i=1; $i<=25; $i++){
			$c = 0;
    	    if($i==1){ 
    	        $c = 1;
    	        $color = "#b4eff7";
    	    }elseif($i==6){ 
    	        $c = 2;
    	        $color = "#c7f196";
    	    }elseif($i==11){ 
    	        $c = 3;
    	        $color = "#ffecb3";
    	    }elseif($i==16){ 
    	        $c = 4;
    	        $color = "#ecb5f4";
    	    }elseif($i==21){ 
    	        $c = 5;
    	        $color = "#f78686";
    	    }if($i==1 || $i==6 || $i==11 || $i==16 || $i==21){ 
				if($det['nomsec'.$c]){
					$html .= '<div class="form-group formato" style="background: '.$color.'">';
    	        		$html .= '<div>';
						$html .= '<strong><u>'.$det['nomsec'.$c].'</u></strong><br>';
    	        	$html .= '</div>';
			}}if($det['pre'.$i]){
					$html .= '<div class="form-group">';
    	                $html .= '<label for="res'.$i.'"><strong>'.$det['pre'.$i].':</strong></label>';
    	                $html .= '<input class="form-control" type="text" id="res'.$i.'" name="res'.$i.'" placeholder="res'.$i.'">';
    	            $html .= '</div>';
    	    }if($i==5 || $i==10 || $i==15 || $i==20 || $i==25){
    	       	$html .= '</div>';
    		}}
	$html .= '</div>';

	echo $html;

    
?>
