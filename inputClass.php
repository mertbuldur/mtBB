<?php 
class help 
{   
    
    static function formopen($array)
    {
         echo '<form action="'.$array['action'].'" method="'.$array['method'].'">';
    }
    
    static function input($array)
    {   
        
        foreach($array as $key => $value)
        {
      echo $value['kapsayici_ac'].'<input type="'.$value['type'].'" name="'.$value['name'].'" 
        class="'.$value['class'].'" value="'.$value['value'].'">'.$value['kapsayici_kapat'];
        }
    }
    
    static function textarea($array)
    {
        echo  $array['kapsayici_ac'].'<textarea name="'.$array['name'].'" class="'.$array['class'].'">'.$array['value'].'</textarea>'.$array['kapsayici_kapat'];
        
    }
    
    static function select($array)
    {
        
        echo  $array['kapsayici_ac'].'<select name="'.$array['name'].'" class="'.$array['class'].'">';
        foreach($array['option'] as $key => $value)
        {
         
            echo '<option value="'.$value['value'].'">'.$value['name'].'</option>';
        }
        
        echo '</select>'.$array['kapsayici_kapat'];
    }
    
    static function formclose()
    {
        echo '</form>';
    }
}
