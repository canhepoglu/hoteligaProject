<?php
    class customer extends hoteliga{
        public function reservationsFuture(){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reservations/Future");
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
            $id = $_REQUEST["id"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reservation/".$id);
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

        
        public function addReservation(){
            $data = array(
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                'bookingAgencyReferenceCode' => $_REQUEST["bookingAgencyReferenceCode"],
                'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'PriceListId' => $_REQUEST["PriceListId"],
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'numAdults' => $_REQUEST["numAdults"],
                'reservationStatus' => $_REQUEST["reservationStatus"],
                'roomId' => $_REQUEST["roomId"],
                'roomTypeId' => $_REQUEST["roomTypeId"],
                'totalAgreedPrice' => $_REQUEST["totalAgreedPrice"],
                'board' => $_REQUEST["board"],
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservation";
            
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


        public function reservations(){
            $data = array(
                'id' => $_REQUEST["id"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservations";
            
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

        public function reservations2(){
            $data = array(
                'id' => $_REQUEST["id"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v2/Reservations";
            
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

        public function reservationsFilter(){
            $data = array(
                'id' => $_REQUEST["id"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservations/Filter";
            
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

        public function reservationsCheckedIn(){
            $data = array(
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'roomTitle' => $_REQUEST["roomTitle"],
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v2/Reservations/CheckedIn";
            
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


        
        public function reservationGuest(){
            $data = array(
                'reservationId' => $_REQUEST["reservationId"],
                'id' => $_REQUEST["id"],
                'isPrimaryGuest' => $_REQUEST["isPrimaryGuest"],
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservation/".$data["reservationId"]."/Guest";
            
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


        public function updateReservation(){
            $data = array(
                'id' => $_REQUEST["id"],
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'reservationStatusId' => $_REQUEST["reservationStatusId"],
                'roomId' => $_REQUEST["roomId"],
                'roomTypeId' => $_REQUEST["roomTypeId"],
                'totalAgreedPrice' => $_REQUEST["totalAgreedPrice"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservation";
            
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

        public function updateReservationId(){
            $data = array(
                'id' => $_REQUEST["id"],
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'reservationStatusId' => $_REQUEST["reservationStatusId"],
                'roomId' => $_REQUEST["roomId"],
                'roomTypeId' => $_REQUEST["roomTypeId"],
                'totalAgreedPrice' => $_REQUEST["totalAgreedPrice"]
            );

            
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservation/".$data["id"];
            
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


        
        public function reservationExtraCharges(){
            $id = $_REQUEST["id"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reservation/".$id."/ExtraCharges");
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

        public function reservationExtraChargesAdd(){
            $id = $_REQUEST["id"];
            $data = array(
                'id' => $_REQUEST["id"],
                'extraChargeId' => $_REQUEST["extraChargeId"],
                'chargeDate' => $_REQUEST["chargeDate"],
                'unitPrice' => $_REQUEST["unitPrice"],
                'quantity' => $_REQUEST["quantity"],
                'notes' => $_REQUEST["notes"],
                'totalExtraTaxes' => $_REQUEST["totalExtraTaxes"]
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservation/".$id."/ExtraCharges";
            
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

        public function deleteReservationExtraCharge(){
            $id = $_REQUEST["id"];
            $id2 = $_REQUEST["id2"];
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "/v1/Reservation/$id/ExtraCharge/$id2";
            
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

        
        public function reservationsGroup(){
            $id = $_REQUEST["id"];
            $data = array(
                'id' => $_REQUEST["id"],
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservations/Group";
            
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


        public function reservationsUngroup(){
            $id = $_REQUEST["id"];
            $data = array(
                'id' => $_REQUEST["id"],
            );
            
            $headers = array(
                'Accept: application/json',
                'Content-type: application/json',
                'Authorization: Bearer '.$this->token,
            );
        
            $url = "https://api.hoteliga.com/v1/Reservations/Ungroup";
            
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

        public function reservatioPayments(){
            $id = $_REQUEST["id"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.hoteliga.com/v1/Reservation/".$id."/Payments");
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