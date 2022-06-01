<?php

namespace app\models\helpers;

class Base64ToImgConverter {
    private $output_file;
    protected $base64_string;

    public function __construct($base64_string, $output_file)
    {
        $this->output_file = $output_file;
        $this->base64_string = $base64_string;
    }

    function base64_to_jpeg() {
        $ifp = fopen( $this->output_file, 'wb' ); 
    
        $data = explode( ',', $this->base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp );

        return true;
    }
}