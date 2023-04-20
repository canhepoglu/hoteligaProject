<?php
    class reservations extends hoteliga{

        //Gelecekteki tüm rezervasyonları alın.
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

        //Bir rezervasyon için saklanan verileri alın.
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

        //Yeni bir rezervasyon oluşturun.
        public function addReservation(){
            $data = array(
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                'bookingAgencyReferenceCode' => isset($_REQUEST["bookingAgencyReferenceCode"]) ? $_REQUEST["bookingAgencyReferenceCode"] : null,
                'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'PriceListId' => isset($_REQUEST["PriceListId"]) ? $_REQUEST["PriceListId"] : null                ,
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'numAdults' => isset($_REQUEST["numAdults"]) ? $_REQUEST["numAdults"] : null,
                'reservationStatus' => $_REQUEST["reservationStatus"],
                'roomId' => isset($_REQUEST["roomId"]) ? $_REQUEST["roomId"] : null,
                'roomTypeId' => $_REQUEST["roomTypeId"],
                'totalAgreedPrice' => $_REQUEST["totalAgreedPrice"],
                'board' => isset($_REQUEST["board"]) ? $_REQUEST["board"] : null,
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

        //Bir dizi mevcut rezervasyon için depolanan verileri alın.
        public function reservations(){

            $data = array(
                'ReservationIds' => $_REQUEST["ReservationIds"]
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

        //Bir dizi rezervasyon için saklanan verileri alın, rezervasyonlardaki müşteri verileri tek bir nesne olarak döndürülür
        public function reservations2(){
            $data = array(
                'id' => $_REQUEST["ReservationIds"]
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

        //Rezervasyon arayın.
        public function reservationsFilter(){
            $data = array(
                'customerNameContains' => $_REQUEST["customerNameContains"]
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

        //Belirtilen tarihler arasındaki rezervasyonlarda check-in yaptırın
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

        //Mevcut misafiri rezervasyona ekle
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

        //Mevcut bir rezervasyonun verilerini güncelleyin.
        public function updateReservation(){
            $data = array(
                'id' => $_REQUEST["id"],
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'reservationStatusId' => $_REQUEST["reservationStatusId"],
                'roomId' => isset($_REQUEST["roomId"]) ? $_REQUEST["roomId"] : null,
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

        //Mevcut rezervasyonun yalnızca seçilen verilerini güncelleyin.
        public function updateReservationId(){
            $data = array(
                'id' => $_REQUEST["id"],
                'bookingAgencyId' => $_REQUEST["bookingAgencyId"],
                //'customer' => $_REQUEST["customer"],
                'currencyCode' => $_REQUEST["currencyCode"],
                'dateFrom' => $_REQUEST["dateFrom"],
                'dateTo' => $_REQUEST["dateTo"],
                'reservationStatusId' => $_REQUEST["reservationStatusId"],
                //'roomId' => $_REQUEST["roomId"],
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

        //Rezervasyon için ekstra ücret alın.        
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

        //Bir rezervasyona ekstra bir ücret ekler.
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
        
            $url = "https://api.hoteliga.com/v1/Reservation/".$id."/ExtraCharge";
            
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

        //Bir rezervasyonun ekstra ücretini silin.
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

        //Grup iki veya daha fazla rezervasyon.
        public function reservationsGroup(){
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

        //Belirtilen sayıda rezervasyonun grubunu çözün, gruptaki kalan rezervasyonları yerinde bırakın. Tüm rezervasyonların grubunun çözülmesi grubu siler.
        public function reservationsUngroup(){
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

        //Bir rezervasyonun ve gruplanmış ödemelerinin ödemelerini alın.
        public function reservationPayments(){
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