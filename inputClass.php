<?php
class fileClasses
{
  private $success;
  private $error;

  public function log()
  {
    if(count($this->success)!=0)
    {
      foreach ($this->success as $key => $value) {
      echo '<font color="green"><b>'.$value."</b></font><br/>";
      }
    }

    if(count($this->error)!=0)
    {
      foreach ($this->error as $key => $value) {
      echo '<font color="red"><b>'.$value."</b></font><br/>";
      }
    }
  }

  public function create($fname)
  {
    if(!file_exists($fname))
    {
      $this->newTouch($fname);
      $this->success[] = $fname." created";
    }
    else
    {
      $this->error[] = "Error : ".$fname." file available";
    }
  }

  public function delete($fname)
  {
    if(file_exists($fname))
    {
      unlink($fname);
      $this->success[] = $fname." Deleted";
    }
    else
    {
      $this->error[] = $fname." Not Found!";
    }
  }

  public function filecopy($fname,$newfname)
  {
    if(file_exists($fname))
    {
        mkdir(dirname($newfname), 0777, true);
        copy($fname,$newfname);
        $this->success[] = "File Copy Success";
    }
    else
    {
      $this->error[] = "Error : ".$fname." Not Found!";
    }
  }

  public function write($fname,$text)
  {
    if(file_exists($fname))
    {
      $fopen = fopen($fname,"a");
      $writer = fwrite($fopen,$text);
      if($writer)
      {
        $this->success[] = $fname." file data added";
      }
      else
      {
        $this->error[] = "Error : ".$fname ." A data file could not be added";
      }
    }
    else
    {
      $this->error[] = $fname." Not Found!";
    }
  }


  public function editname($fname,$newname)
  {
    if(file_exists($fname))
    {
      rename($fname,$newname);
      $this->success[] = $fname." change to ".$newname." success";
    }
    else
    {
      $this->error[] = "Error : ".$fname." Not Found!";
    }
  }

  public function getInfo($fname)
  {
    $x =  stat($fname);
    $create_date=date("Y-m-d / H:i:s",filectime($fname));
    $last_connect = date("Y-m-d / H:i:s",$x[8]);
    $last_edit = date("Y-m-d / H:i:s",$x[9]);
    $size = $this->getsize($x[7]);
    return array("create_date"=>$create_date,"last_connect"=>$last_connect,"last_edit"=>$last_edit,"file_size"=>$size);
  }



  public function _mkdir($path, $mode = 0777)
  {
        $old = umask(0);
        $res = @mkdir($path, $mode);
        umask($old);
        return $res;
  }
  public function rmkdir($path, $mode = 0777)
    {
        return is_dir($path) || ( $this->rmkdir(dirname($path), $mode) && $this->_mkdir($path, $mode) );
    }

  public function  getsize($size) {
        $last = strtolower($size{strlen($size)-1});
        switch($last) {
            case 'g':
                $size *= 1024;
            case 'm':
                $size *= 1024;
            case 'k':
                $size *= 1024;
        }
        return $size;
    }
  public function newTouch($path)
  {
     $path = explode('/',$path);
     $endKey = $this->endKey($path);
     $filename = end($path);
     unset($path[$endKey]);
     $new_path = implode('/',$path);
     $this->rmkdir($new_path); // klasÃ¶r oluÅŸturuldu.
     touch($new_path."/".$filename); // dosya oluÅŸturuldu.

  }


  public function endKey($array)
  {
    end($array);
    return key($array);
  }
}
