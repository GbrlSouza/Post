from flask import Flask, request, jsonify
import xml.etree.ElementTree as ET
from datetime import datetime
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

def criar_ou_atualizar_xml(nome_arquivo, dados_post):
    tree = None
    try:
        tree = ET.parse(nome_arquivo)
        root = tree.getroot()
    except FileNotFoundError:
        root = ET.Element("Posts")
        tree = ET.ElementTree(root)

    post = ET.Element("Post")
    ET.SubElement(post, "Titulo").text = dados_post.get("titulo")
    ET.SubElement(post, "Subtitulo").text = dados_post.get("subtitulo")
    ET.SubElement(post, "Assunto").text = dados_post.get("assunto")
    ET.SubElement(post, "Imagem").text = dados_post.get("imagem")
    ET.SubElement(post, "Conteudo").text = dados_post.get("conteudo")
    ET.SubElement(post, "DataHora").text = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    root.append(post)
    tree.write(nome_arquivo, encoding="utf-8", xml_declaration=True)

def ler_posts_xml(nome_arquivo):
    try:
        tree = ET.parse(nome_arquivo)
        root = tree.getroot()
        posts = []
        
        for post in root.findall("Post"):
            posts.append({
                "titulo": post.find("Titulo").text,
                "subtitulo": post.find("Subtitulo").text,
                "assunto": post.find("Assunto").text,
                "imagem": post.find("Imagem").text,
                "conteudo": post.find("Conteudo").text,
                "data_hora": post.find("DataHora").text
            })
        return posts
    except FileNotFoundError:
        return []

@app.route('/get_posts', methods=['GET'])
def get_posts():
    posts = ler_posts_xml("posts.xml")
    return jsonify(posts)

@app.route('/add_post', methods=['POST'])
def add_post():
    data = request.get_json()
    criar_ou_atualizar_xml("posts.xml", data)
    return jsonify({"message": "Post adicionado com sucesso!"}), 201

if __name__ == '__main__':
    app.run(debug=True, host='127.0.0.1', port=5000)
