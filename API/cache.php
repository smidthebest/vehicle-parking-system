<?php

class Cache {
    public $cachefile; 
    private const CACHETIME = 2592000;

    public function __construct($url){
        $file = Explode('&', Explode('?', $url)[1]);
        $ans = Explode('.', $file[0])[0]."-".Explode('.', $file[1])[0].$file[2]; 
        $this->cachefile = 'cache/cached-'.$ans.'.json';     
    }

    public function getCache(){
        if (file_exists($this->cachefile) && time() - self::CACHETIME < filemtime($this->cachefile)) {
            readfile($this->cachefile);
           return true; 
        }
        else return false; 
    }

    // Cache the contents to a cache file 
    public function putCache(){
        $cached = fopen($this->cachefile, 'w');
        fwrite($cached, ob_get_contents());
        fclose($cached);
        ob_end_flush(); // Send the output to the browser
    }
}

function top_cache(){
    $url = $_SERVER["REQUEST_URI"];
    $cache = new Cache($url); 

    if($cache->getCache()){
        exit;
    }
    else {
        ob_start(); // Start the output buffer
        return $cache; 
    }

}

function bottom_cache($cache){
    $cache->putCache(); 

}


?>
