<?php
    class ClassLoader {
        public static function load() {
            foreach (glob(__DIR__ . '/back/br.com.age.models/*.php') as &$filename)
            {
                require $filename;
            }
        
            foreach (glob(__DIR__ . '/back/br.com.age.dao.utils/*.php') as &$filename)
            {
                require $filename;
            }
        
            foreach (glob(__DIR__ . '/back/br.com.age.dao/*.php') as &$filename)
            {
                require $filename;
            }
        
            foreach (glob(__DIR__ . '/back/br.com.age.services/*.php') as &$filename)
            {
                require $filename;
            }
        }
    }
?>