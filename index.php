<?php
	function getVideoID($video){
        
        if(substr($video,0,4) == "http"){
            $v = explode(".",$video);
            if($v['1']=="youtube"){
                $v = explode("&",$v['2']);
                $v = explode("=",$v['0']);
            }else{
                $v = explode("/",$v[1]);
        	}
        }elseif(substr($video,1,6) == "iframe"){
            $doc = new DOMDocument();
            $doc->loadHTML($video);
            
            $v = $doc->getElementsByTagName('iframe')->item(0)->getAttribute('src');
            $v = explode("embed/",$v);
        }else{
            exit('Invalid video link or embed code');
        }
        
        return $v[1];
	}


    if(isset($_POST['getid'])){
        if(!empty($_POST['video'])){
            $v = getVideoID($_POST['video']);
            exit('Video ID: ' . $v);
        }else{
            echo 'Please enter value';
        }
    }
?>

<form method="post">
    <label>Youtube link or embed code</label> <br>
    <input type="text" name="video"><br>
    
    <input type="submit" name="getid">
    
</form>