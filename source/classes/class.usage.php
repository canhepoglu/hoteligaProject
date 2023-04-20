<?php
    class usage extends hoteliga{
        
        //API kullanım kaynağı, API sınırları ve kullanılan çağrılar hakkında bilgi sağlar.
        public function usage(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Usage");
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
    }