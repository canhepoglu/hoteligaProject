<?php
    class extraCharge extends hoteliga{
        
        public function extraCharges(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/ExtraCharges");
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

        public function extraChargeCategories(){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/ExtraCharge/Categories");
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

        public function extraChargePos(){

            $data = array(
                'items' => $_REQUEST["items"],
                'sum' => $_REQUEST["sum"],
                'timeStamp' => $_REQUEST["timeStamp"],
                'roomTitle' => $_REQUEST["roomTitle"],
                'lastName' => $_REQUEST["lastName"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/ExtraCharge/Pos";
            
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
                );
            } else { 
                $result = array(
                    'success' => false,
                    'error_code' => $responseCode,
                );
            }
            
            return $result;
        }

        public function extraChargeUpdatePos(){
            
            $data = array(
                'items' => $_REQUEST["Items"],
                'timeStamp' => $_REQUEST["TimeStamp"],
                'roomTitle' => $_REQUEST["RoomTitle"],
                'lastName' => $_REQUEST["lastName"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/ExtraCharge/UpdatePos";
            
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

    }