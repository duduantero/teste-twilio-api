<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Twilio\Rest\Client;
$config = include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os dados do formulário
    $phoneNumber = $_POST["phoneNumber"];
    $message = $_POST["message"];
    
    // Include the Twilio PHP library
    require_once 'twilio-php-app/vendor/autoload.php';

    $sid = $config['sid'];
    $token = $config['token'];

    // Criar uma instância do cliente Twilio
    $twilio = new Client($sid, $token);

    // Send a WhatsApp message
    $message = $twilio->messages->create(
        "whatsapp:$phoneNumber", // to
        array(
            "from" => "whatsapp:+14155238886",
            "body" => $message
        )
    );

    // Confirmação de envio
    echo "<div>Mensagem enviada para $phoneNumber: \"$message->body\"</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enviar Mensagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Envio de Mensagem</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="phoneNumber">N�mero de Telefone:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Digite o n�mero de telefone" required>
        
        <label for="message">Mensagem:</label>
        <textarea id="message" name="message" rows="4" placeholder="Digite sua mensagem" required></textarea>
        
        <button type="submit">Enviar Mensagem</button>
    </form>
</body>
</html>
