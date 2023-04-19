<?php
    class payment extends hoteliga{

        public function createPayment(){

            $data = array(
                'paymentDate' => $_REQUEST["paymentDate"],
                'reservationId' => $_REQUEST["reservationId"],
                'invoiceId' => $_REQUEST["invoiceId"],
                'paymentMethodId' => $_REQUEST["paymentMethodId"],
                'amount' => $_REQUEST["amount"],
                'amountCurrency' => $_REQUEST["amountCurrency"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'exchangeRate' => $_REQUEST["exchangeRate"],
                'notes' => $_REQUEST["notes"]
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


        public function updatePayment(){
            
            $data = array(
                'id' => $_REQUEST["id"],
                'paymentDate' => $_REQUEST["paymentDate"],
                'invoiceId' => $_REQUEST["invoiceId"],
                'paymentMethodId' => $_REQUEST["paymentMethodId"],
                'amount' => $_REQUEST["amount"],
                'amountCurrency' => $_REQUEST["amountCurrency"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'exchangeRate' => $_REQUEST["exchangeRate"],
                'notes' => $_REQUEST["notes"]

            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Payment";
            
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

        public function deletePayment(){

            $data = array(
                'id' => $_REQUEST["id"]
            );

            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Payment/".$data["id"];
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