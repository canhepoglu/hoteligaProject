<?php 
    class hoteliga{
        public $username;
        public $password;
        public $domain;
        public $token;
        
        public function __construct(){
            $config = include_once('config.php');
            $this->username = $config['username'];
            $this->password = $config['password'];
            $this->domain = $config['domain'];
            $this->get_hoteliga_token();
        }

        //Kimliği doğrulanmış isteklerde bulunabilmek için bir OAuth taşıyıcı jetonu alın.
        public function get_hoteliga_token() {
            $headers = array(
                'Content-type: application/x-www-form-urlencoded'
            );
            
            $token_url = "https://api.hoteliga.com/v1/Token";
            $token_data = array(
                'grant_type' => 'password',
                'username' => $this->username,
                'password' => $this->password,
                'domain' => $this->domain
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $token_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));
            
            try {
                $response = curl_exec($ch);
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $header = substr($response, 0, $header_len);
                $body = substr($response, $header_len);
                
                if ($responseCode == 200){ 
                    $this->token = json_decode($body, true)['access_token'];
                    return $this->token;
                } else { 
                    throw new Exception("Could not get token. Response code: " . $responseCode);
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            } finally {
                curl_close($ch);
            }
        }
    }