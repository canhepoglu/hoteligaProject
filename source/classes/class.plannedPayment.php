<?php
    class plannedPayment extends hoteliga{
        
        //BookingId ile ilişkili bir planlı ödeme alın.
        public function plannedPaymentsReservationId(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/PlannedPayments/".$_REQUEST["reservationId"]);
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

        //Bir rezervasyona planlı bir ödeme ekleme.
        public function addPlannedPayment() {
            $url = 'https://api.hoteliga.com/v1/PlannedPayment';

            $data = array(
                'Amount' => $_REQUEST["amount"],
                'CurrencyCode' => $_REQUEST["currencyCode"],
                'PaymentDescriptionId' => $_REQUEST["paymentDescriptionId"],
                'PlannedDate' => $_REQUEST["plannedDate"],
                'ReservationId' => $_REQUEST["reservationId"]
            );
            
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($response);
        }

        //Planlanan bir ödemeyi güncelleyin.
        public function updatePlannedPayment() {
            $url = "https://api.hoteliga.com/v1/PlannedPayment";

            $data = array(
                'Id' => $_REQUEST["id"],
                'Amount' => $_REQUEST["amount"],
                'CurrencyCode' => $_REQUEST["currencyCode"],
                'PaymentDescriptionId' => $_REQUEST["paymentDescriptionId"],
                'PlannedDate' => $_REQUEST["plannedDate"],
                'ReservationId' => $_REQUEST["reservationId"]
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

        //Planlanan bir ödemeyi silin.
        public function deletePlannedPayment() {

            $id = $_REQUEST["id"];

            $url = "https://api.hoteliga.com/v1/PlannedPayment/".$id;
            
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->token
            );
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);
            
            return json_decode($response);
        }
        
        
        
    }