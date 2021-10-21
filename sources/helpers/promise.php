<?php

class Promise {
        protected $boolean = true;
        protected $data;

        function ready ( $input ) {
            $this->data = $input;
            return self::resolve($this->data);
        }

        function then ( $function ) {
            if($this->boolean) {
                $return = $function($this->data);

                if($return == null)
                    return self::resolve($this->data);
                else
                    return $return;
            } else {
                return self::reject($this->data);
            }
        }

        function catch ( $function ) {
            if(!$this->boolean) {
                $return = $function($this->data);

                if($return == null)
                    return self::resolve($this->data);
                else 
                    return $return;
            } else {
                return self::resolve($this->data);
            }
        }

        function finally ( $function ) {
            return $function($this->data);
        }

        public static function resolve ($data) {
            $resolve = new self();
            $resolve->data = $data;
            
            return $resolve;
        }

        public static function reject ($data) {
            $reject = new self();
            $reject->data = $data;
            $reject->boolean = false;
            return $reject;
        }
    }

   

