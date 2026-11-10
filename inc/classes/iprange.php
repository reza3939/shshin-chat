<?php

    class IpRange implements Iterator
    {
        protected $count; 
       
        protected $a; 
        protected $b; 
        protected $c; 
        protected $d; 
       
        protected $ca;
        protected $cb;
        protected $cc;
        protected $cd;
       
        protected $isValid;
   
        public function __construct($string)
        {
            if(preg_match('#^(\d+|\d+-\d+)\.(\d+|\d+-\d+)\.(\d+|\d+-\d+)\.(\d+|\d+-\d+)$#', $string, $matches) !== 1)
            {
                throw new InvalidArgumentException('Invalid format.  Each octet should either be a number between 0 and 255, or a range "40-120"');
            }
            foreach(array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd') as $i => $position)
            {
                $range = $matches[$i];

                if(strpos($range, '-') !== false)
                {
                    list($low, $high) = explode('-', $range);
                }
                else
                {
                    list($low, $high) = array($range, $range);
                }
               
                if($high > 255) throw new InvalidArgumentException("Invalid IP address.  The octet '$high' cannot be greater than 255");

                if($low > $high) list($high, $low) = array($low, $high);
               
                $this->{$position} = array('l' => $low, 'h' => $high);
            }
           
            $this->rewind();
        }
       
        public function current()
        {
            return "{$this->ca}.{$this->cb}.{$this->cc}.{$this->cd}";
        }
       
        public function key()
        {
            return $this->count;
        }
       
        public function rewind()
        {
            $this->ca = $this->a['l'];
            $this->cb = $this->b['l'];
            $this->cc = $this->c['l'];
            $this->cd = $this->d['l'];
           
            $this->count = 0;
           
            $this->isValid = true;
        }
       
        public function valid()
        {
            return $this->isValid;
        }
       
        public function next()
        {
            $this->count++;
			
            foreach(array('d', 'c', 'b', 'a', null) as $position)
            {
                if($position === null)
                {
                    $this->isValid = false;
                    break;
                }
                if($this->{"c$position"} < $this->{$position}['h'])
                {
                    $this->{"c$position"}++;
                    break;
                }
                else
                {
                    $this->{"c$position"} = $this->{$position}['l'];
                }
            }
        }
    }