<?php
    class report extends hoteliga{
        
        //Belirli bir rapora aktarın.
        public function report(){

            $data = array(
                'id' => $_REQUEST["id"],
                'parameters' => $_REQUEST["parameters"],
                'output' => $_REQUEST["output"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Report";
            
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
                    'code' => $responseCode,
                    'data' => $response,
                );
            } else { 
                $result = array(
                    'success' => false,
                    'code' => $responseCode,
                );
            }
            return $result;
        }
    }