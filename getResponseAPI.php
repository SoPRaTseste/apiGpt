<?php

    if(isset($_POST['mensagem'])) {

        $mensagem = $_POST['mensagem'];

        $OPENAI_API_KEY = "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";

        $ch = curl_init();
        $headers  = [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $OPENAI_API_KEY . ''
        ];

        $postData = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $mensagem],
            ],
            'max_tokens' => 100,
            'temperature' => 0.9,
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $respostaJSON = curl_exec($ch);

        $respostaArray = json_decode($respostaJSON, true);


        if ($respostaArray !== null) {
            $conteudoResposta = $respostaArray['choices'][0]['message']['content'];

            echo $conteudoResposta;
        } else {
            echo "Erro ao decodificar a resposta JSON.";
        }

        curl_close($ch);
    }

?>
