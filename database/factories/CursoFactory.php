<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->realText(rand(10, 15)),
            'resumen' => $this->faker->realText(rand(200, 300)),
            'imagen' => $this->file_get_contents_curl('https://placeimg.com/640/480/any'),
            'autor_id' => rand(1,10)
        ];
    }

  
    function file_get_contents_curl($url) {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
    
        $data = curl_exec($ch);
        curl_close($ch);
        
        $imagen = 'curso-'.rand(11111,99999999).'.png';
        $fp = 'public/images/'.$imagen;
        //file_put_contents( $fp, $data );

        Storage::disk('local')->put($fp, $data);

        
        return $imagen;
    }
  

}
