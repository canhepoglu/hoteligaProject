<?php
    class guest extends hoteliga{
        public function guestList(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Guests");
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
        public function guestView(){
            $id = $_REQUEST["id"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Guest/"+$id);
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
        public function reservationView(){
            $reservationId = $_REQUEST["reservationId"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Guests/"+$reservationId);
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
        public function addGuest(){
            $data = array(
                'FirstName' => $_REQUEST["FirstName"],
                'LastName' => $_REQUEST["LastName"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Guest";
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HEADER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => true,
                CURLOPT_POSTFIELDS => json_encode($data),
            ));
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_len);
            $body = substr($result, $header_len);
            
            if ($responseCode == '200') { 
                $response = json_decode($body, true); 
                $result = array(
                    'success' => true,
                    'id' => $response['id'],
                );
            } else { 
                $result = array(
                    'success' => false,
                    'error_code' => $responseCode,
                );
            }
            
            return $result;

        }
        public function updateGuest(){
            
            $data = array(
                'id' => $_REQUEST["id"],
                'FirstName' => $_REQUEST["FirstName"],
                'LastName' => $_REQUEST["LastName"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Guest";
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_HEADER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => true,
                CURLOPT_POSTFIELDS => json_encode($data),
            ));
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_len);
            $body = substr($result, $header_len);
            
            if ($responseCode == '200') { 
                $response = array(
                    'success' => true,
                    'code' => $responseCode,
                );
            } else { 
                $response = array(
                    'success' => false,
                    'code' => $responseCode,
                );
            }
            
            return $response;
        }

        public function deleteGuest(){

            $data = array(
                'id' => $_REQUEST["id"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Guest/".$data["id"];
            
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "DELETE",
                CURLOPT_HEADER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE => true,
            ));
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_len);
            $body = substr($result, $header_len);
            
            if ($responseCode == '200') { 
                $response = array(
                    'success' => true,
                    'code' => $responseCode,
                );
            } else { 
                $response = array(
                    'success' => false,
                    'code' => $responseCode,
                );
            }
            
            return $response;
        }

    }