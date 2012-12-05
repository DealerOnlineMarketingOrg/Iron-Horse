<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function encrypt_password($pass) {
        $salt = sha1(md5(sha1(md5($pass))));
        return $salt;	
    }         
        
    function createRandomString($length = 8, $type = "") {
        $alphabets = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $numbers = "23456789";
        $symbols = "!@#$%^*()+?";
 
        switch(strtoupper($type)) {
            case 'ALPHANUMSYM': $charString         = $alphabets . strtolower($alphabets) . $numbers . $symbols;  break;
            case 'ALPHANUM': $charString            = $alphabets . strtolower($alphabets) . $numbers;             break;
            case 'UPPERALPHANUMSYM': $charString    = $alphabets . $numbers  . $symbols;                          break;
            case 'LOWERALPHANUMSYM': $charString    = strtolower($alphabets) . $numbers   . $symbols;             break;
            case 'ALPHASYM': $charString            = $alphabets             . strtolower($alphabets) . $symbols; break;
            case 'ALPHA': $charString               = $alphabets             . strtolower($alphabets);            break;
            case 'LOWERALPANUM': $charString        = strtolower($alphabets) . $numbers;                          break;
            case 'UPPERALPHANUM': $charString       = $alphabets             . $numbers;                          break;
            case 'NUMSYM': $charString              = $numbers               . $symbols;                          break;
            case 'LOWERALPHASYM': $charString       = strtolower($alphabets) . $symbols;                          break;
            case 'UPPERALPHASYM': $charString       = $alphabets             . $symbols;                          break;
            case 'LOWERALPHA':$charString           = strtolower($alphabets);                                     break;
            case 'UPPERALPHA': $charString          = $alphabets;                                                 break;
            case 'NUM': $charString                 = $numbers;                                                   break;
            case 'SYM': $charString                 = $symbols;                                                   break;
            default: $charString                    = $alphabets             . strtolower($alphabets) . $numbers . $symbols;
        }
         
        srand((double)microtime() * 1000000);
        $count = 1;
        $randomString = "";
         
        while ($count <= $length) {
            $startChar = rand(0, strlen($charString) - 1);
            $tempChar = substr($charString, $startChar, 1);
            $randomString = $randomString . $tempChar;
            $count++;      
        }
 
        return $randomString;
    }