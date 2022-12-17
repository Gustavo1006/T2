<?php 
    function resizeImg($s_img, $d_img, $w_max, $h_max) {          
        static $img_types = array( 
            1 => 'Gif', 
            2 => 'Jpeg', 
            3 => 'Png' 
        ); 
         
        if (file_exists($s_img)) { 
            // Obtiene el tipo del fichero 
            list(,,$type) = getImageSize($s_img); 
             
            // No se reconoce el tipo del fichero 
            if (!isset($img_types[$type])) { 
                trigger_error('No se reconoce el tipo de imagen', E_USER_WARNING); 
                return false; 
            } 
             
            // Se define función que creará la imagen y se comprueba que exista 
            if (!function_exists($f_create = 'imageCreateFrom' . $img_types[$type])) { 
                trigger_error("No existe la función '{$f_create}' necesaria para abrir la imagen.", E_USER_WARNING); 
                return false; 
            } 
             
            // Crea la imagen a partir del fichero y comprueba que se haya cargado bien 
            if (!$img = $f_create($s_img)) { 
                trigger_error("No se pudo abrir el fichero correctamente.", E_USER_WARNING); 
                return false; 
            } 

            // Obtiene el tamaño de la imagen original 
            list($aw, $ah) = array(imageSX($img), imageSY($img)); 
             
            // Si el ancho o el alto de la imagen es menor o igual a 0 
            if ($aw <= 0 || $ah <= 0) { 
                trigger_error("El tamaño de la imagen es incorrecto.", E_USER_WARNING); 
                return false; 
            } 
             
            // Se calcula la proporción de la imagen 
           /*if ($aw > $ah) { 
                $nw = $w_max; 
                $nh = ($nw / $aw) * $ah; 
            } else { 
                $nh = $h_max; 
                $nw = ($nh / $ah) * $aw; 
            } */

                $nw = $w_max; 
                $nh = ($nw / $aw) * $ah; 

            // Si se puede crear la imagen a color verdadero se crea 
            if (function_exists('imageCreateTrueColor')) { 
                $img2 = imageCreateTrueColor($nw, $nh); 
            } else { 
                if (function_exists('imageCreate')) { 
                    trigger_error("No existe la función 'imageCreate', no se puede crear la imagen.", E_USER_WARNING); 
                    return false; 
                } 
                 
                $img2 = imageCreate($nw, $nh); 
            } 
            if (!$img2) { 
                trigger_error("No se pudo crear la imagen correctamente.", E_USER_WARNING); 
                return false; 
            } 

            // Se intenta usar imageCopyResampled 
            if (function_exists('imageCopyResampled')) { 
                imageCopyResampled($img2, $img, 0, 0, 0, 0, $nw, $nh, $aw, $ah); 
            } else { 
                if (function_exists('imageCopyResized')) { 
                    trigger_error("No existe la función 'imageCopyResized', no se puede redimensionar la imagen.", E_USER_WARNING); 
                    return false; 
                } 
                 
                imageCopyResized($img2, $img, 0, 0, 0, 0, $nw, $nh, $aw, $ah); 
            } 

            // Se comprueba que exista la función para guardar la imagen, en caso 
            // contrario se prueban otros formatos. 
            foreach(array($img_types[$type], 'Jpeg', 'Png') as $type_t) { 
                if (function_exists($f_save = 'image' . $type_t)) { 
                    // Se guarda la imagen 
                    if ($f_save($img2, $d_img)) return true;                     
                }                 
            } 
             
            trigger_error("No se pudo guardar la imagen en '{$d_img}'.", E_USER_WARNING); 
            return false; 
        } 

        trigger_error("No existe el fichero '{$s_img}'.", E_USER_WARNING); 
        return false; 
    } 
	
           	
?>
