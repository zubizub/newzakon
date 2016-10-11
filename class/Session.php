<?php
class Session{
        
        /**
        * 
        * @var Ключ сессии, в которой будут содержаться одноразованые сообщения
        * 
        */
        private static $key = 'flash';
        
        /**
        * Для записи и получения одноразового сообщения из сессии
        * @param string/integer $key
        * @param mixed $value
        * 
        * @return значение при получении, void при установке 
        */
        public static function flash( $key, $value=null ){
            # Если значение не указано
            if( is_null( $value ) ){
                # Если такой ключ в сессии есть            
                if( isset( $_SESSION[self::$key][$key] ) ){
                    # Получаем значение
                    $value = $_SESSION[self::$key][$key];
                    
                    # Уничтожаем значение сессии
                    unset( $_SESSION[self::$key][$key] );
                    
                    # Возвращаем значение
                    return $value;
                }
 
                # По умолчанию
                return false;
            }
            
            # Записываем значение в сессию
            $_SESSION[self::$key][$key] = $value;
        }
    }
?>