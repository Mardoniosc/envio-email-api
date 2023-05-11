<?php

require_once ("../util/app_response.php");

$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method){
    case 'POST':
        $data = App_Response::getPayloadJson();

        if($data['token'] === 'AJSLDKFJLJKL34J5LJ2346H(&**9SDFLKGJSLKDFJG') {

            // ------------------------ ENVIANDO E-MAIL ------------------------ 
            $data_envio = date('d/m/Y');
            $hora_envio = date('H:i:s');

            $nome_origem = $data['nome_origem'];
            $email_origem = $data['email_origem'];

            // É necessário indicar que o formato do e-mail é html
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: $nome_origem <$email_origem>";
            $headers .= "Bcc: suporte@servicosmsc.com.br\r\n";
            $enviaremail = mail($data['email_destino'], $data['assunto'], $data['mensagem_html'], $headers);
    
            // ------------------------ FIM ENVIO DE E-MAIL ------------------------ 
    
            if ($enviaremail) {
                $response['mensagem'] = 'E-MAIL ENVIADO COM SUCESSO!';
                App_Response::converterJson($response);
            } else {
                App_Response::getResponse(500); 
            }
            break;   
        }
        
        App_Response::getResponse(402); 
        break;  


    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
