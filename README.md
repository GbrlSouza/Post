# Gerenciador de Posts com Flask e Bootstrap

Este projeto é um gerenciador de posts web que permite a criação e exibição de posts. Os posts são salvos em um arquivo XML, e o frontend exibe esses posts em cards utilizando **Bootstrap** para o layout. O backend foi desenvolvido com **Flask**, o que permite manipular as informações e servir os dados para a interface web.

## Funcionalidades

- **Adicionar Novo Post**: Formulário que coleta informações como título, subtítulo, assunto, imagem e conteúdo do post.
- **Listar Posts**: Exibe todos os posts salvos em um arquivo XML no formato de cards responsivos.
- **Salvar Posts em XML**: O backend utiliza um arquivo XML para armazenar e carregar os posts.
- **Atualizar em Tempo Real**: Após a criação de um post, a lista de posts é automaticamente atualizada no frontend.

## Estrutura do Projeto

- **app.py**: Arquivo principal que define as rotas do servidor Flask, processa o formulário, salva e carrega posts do arquivo XML.
- **templates**: Pasta que contém o arquivo HTML com o formulário e o layout da lista de posts.
- **static**: Diretório para armazenar os arquivos CSS, JS e qualquer outro arquivo estático usado na interface.

## Pré-requisitos

- Python 3.x
- Bibliotecas: Flask, Bootstrap (integrada via CDN)

### Instalando o Flask

Instale o Flask usando o pip:

```bash
pip install flask
```

## Configuração

1. Clone o repositório ou copie os arquivos necessários para um diretório local.
2. No diretório do projeto, execute o arquivo `app.py`:

```bash
python app.py
```

3. Acesse o sistema via navegador em `http://127.0.0.1:5000`.

## Estrutura do Código

- **Backend (Flask)**:
  - `@app.route('/add_post')`: Recebe as informações do post via método `POST`, salva no arquivo XML e retorna uma mensagem de sucesso.
  - `@app.route('/get_posts')`: Retorna todos os posts do arquivo XML em formato JSON para o frontend exibir como cards.

- **Frontend (HTML, Bootstrap, JavaScript)**:
  - **Formulário**: Coleta o título, subtítulo, assunto, imagem e conteúdo do post. O formulário envia os dados para o backend em JSON via `fetch API`.
  - **Exibição dos Posts**: Requisição ao endpoint `/get_posts` do Flask para obter e exibir os posts salvos.

### Exemplo de Post

Cada post salvo no XML contém:
- `Título do Post`
- `Subtítulo do Post`
- `Assunto do Post`
- `Imagem (URL)`
- `Conteúdo`
- `Data e Hora` do post (adicionada automaticamente no momento da criação)

## Tecnologias Utilizadas

- **Python & Flask**: Backend e manipulação do arquivo XML
- **Bootstrap**: Estilização e responsividade da interface
- **JavaScript (Fetch API)**: Envio de dados do formulário e atualização da lista de posts

## Melhorias Futuras

- **Validação de Dados**: Validar o formulário no frontend e backend para evitar entradas inválidas.
- **Edição e Exclusão de Posts**: Adicionar funcionalidades para editar e remover posts.
- **Paginação**: Implementar paginação para listas grandes de posts.

## Exemplo de Uso

1. Preencha o formulário com as informações do post e clique em "Adicionar Post".
2. O post será salvo no XML e exibido automaticamente na seção de posts, com a imagem, título, subtítulo, assunto, conteúdo e data.

---

Com esta aplicação simples e funcional, você pode gerenciar facilmente os posts em uma interface intuitiva e responsiva, enquanto o backend em Flask armazena os dados em XML.
