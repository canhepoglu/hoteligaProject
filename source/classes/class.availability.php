<?php
    class availability extends hoteliga{
        
        //Belirli bir süre için müsait odaları alın.
        public function availabilityRoom() {
            $url = 'https://api.hoteliga.com/v1/Availability/Room';

            $data = array(
                'dateFrom' => $_REQUEST['dateFrom'],
                'dateTo' => $_REQUEST['dateTo'],
                'groupDates' => $_REQUEST['groupDates']
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

        //Belirli bir BookingAcente için ve belirli bir süre için RoomType başına müsaitlik durumu alır.
        public function getRoomTypeAvailability() {
            $url = 'https://api.hoteliga.com/v1/Availability/RoomType/Combined';
                       
            $data = array(
                'dateFrom' => $_REQUEST['dateFrom'],
                'dateTo' => $_REQUEST['dateTo'],
                'bookingAgencyId' => $_REQUEST['bookingAgencyId'] ?? null,
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


        public function getRoomTypeAvailabilityCombinedExtended() {
            $url = 'https://api.hoteliga.com/v1/Availability/RoomType/CombinedExtended';

            $data = array(
                'dateFrom' => $_REQUEST['dateFrom'],
                'dateTo' => $_REQUEST['dateTo'],
                'bookingAgencyId' => $_REQUEST['bookingAgencyId'] ?? null,
                'promoCode' => $_REQUEST['promoCode'] ?? null,
                'currencyCode' => $_REQUEST['currencyCode'] ?? null
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
        
        
    }