<?php
    class paymentMethod extends hoteliga{
        
        //Mevcut tüm ödeme yöntemlerini alın
        public function paymentMethods(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/PaymentMethods");
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