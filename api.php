<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Headers, Authorization");

function criar_ou_atualizar_xml($nome_arquivo, $dados_post) {
    $xml = simplexml_load_file($nome_arquivo);

    if ($xml === false) {
        $xml = new SimpleXMLElement('<Posts/>');
    }

    $post = $xml->addChild('Post');
    $post->addChild('Titulo', $dados_post['titulo']);
    $post->addChild('Subtitulo', $dados_post['subtitulo']);
    $post->addChild('Assunto', $dados_post['assunto']);
    $post->addChild('Imagem', $dados_post['imagem']);
    $post->addChild('Conteudo', $dados_post['conteudo']);
    $post->addChild('DataHora', date('Y-m-d H:i:s'));

    $xml->asXML($nome_arquivo);
}

function ler_posts_xml($nome_arquivo) {
    $posts = [];

    if (file_exists($nome_arquivo)) {
        $xml = simplexml_load_file($nome_arquivo);

        foreach ($xml->Post as $post) {
            $posts[] = [
                'titulo' => (string)$post->Titulo,
                'subtitulo' => (string)$post->Subtitulo,
                'assunto' => (string)$post->Assunto,
                'imagem' => (string)$post->Imagem,
                'conteudo' => (string)$post->Conteudo,
                'data_hora' => (string)$post->DataHora,
            ];
        }
    }

    return $posts;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/get_posts') {
    $posts = ler_posts_xml('posts.xml');
    echo json_encode($posts);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/add_post') {
    $data = json_decode(file_get_contents('php://input'), true);
    criar_ou_atualizar_xml('posts.xml', $data);
    echo json_encode(['message' => 'Post adicionado com sucesso!']);
    exit;
}
