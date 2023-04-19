<?php
    class reference extends hoteliga{
        
        public function countries(){
            $languageCode = $_REQUEST["languageCode"];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reference/Countries/".$languageCode);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->token,
                "Content-Type: application/json"
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            if ($response === false) {
                die('Curl error: ' . curl_error($ch));
            }
            
            $data = json_decode($response);
        
            return $data;

        }

        public function provinces(){
            $countryCode = $_REQUEST["countryCode"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reference/Provinces/".$countryCode."");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->token,
                "Content-Type: application/json"
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            exit($response);
            curl_close($ch);
            
            if ($response === false) {
                die('Curl error: ' . curl_error($ch));
            }
            
            $data = json_decode($response);
        
            return $data;

        }
    }