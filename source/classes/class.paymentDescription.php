<?php
    class paymentDescription extends hoteliga{

        //Tüm ödeme açıklamalarını alın.
        public function getPaymentDescriptions(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/PaymentDescriptions");
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
            
            return json_decode($response);
        }

        //Bir ödeme açıklaması ekleme.
        public function addPaymentDescription() {
            $url = 'https://api.hoteliga.com/v1/PaymentDescription';
            
            $data = array(
                'Description' => $_REQUEST['description'],
                'IsEnabled' => $_REQUEST['isEnabled']
            );

            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );

            $data_string = json_encode($data);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($response);
        }

        //Bir ödeme açıklamasını güncelleyin.
        public function updatePaymentDescription() {
            $url = "https://api.hoteliga.com/v1/PaymentDescription";

            $data = array(
                'Id' => $_REQUEST["id"],
                'Description' => $_REQUEST["description"],
                'IsEnabled' => $_REQUEST["isEnabled"]
            );
            
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($response);
        }

        //Bir ödeme açıklaması kaldırılıyor.
        public function deletePaymentDescription() {
            $id = $_REQUEST["id"];
            $url = "https://api.hoteliga.com/v1/PaymentDescription/".$id;
            
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            curl_setopt($ch, CURLOPT_NOBODY, true);
            
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_close($ch);
            
            return ($http_status);
        }
        
    }