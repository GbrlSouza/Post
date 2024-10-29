const baseUrl = window.location.origin;
const postForm = document.getElementById('postForm');
const postsContainer = document.getElementById('postsContainer');

async function carregarPosts() {
    try {
        const response = await fetch(baseUrl + '/get_posts');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const posts = await response.json();
        exibirPosts(posts);
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
}

function exibirPosts(posts) {
    postsContainer.innerHTML = '';
    posts.forEach(post => {
        const postCard = document.createElement('div');
        postCard.classList.add('col');
        postCard.innerHTML = `
            <div class="card h-100">
                <img src="${post.imagem}" class="card-img-top" alt="Imagem do Post">
                <div class="card-body">
                    <h5 class="card-title">${post.titulo}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">${post.subtitulo}</h6>
                    <p class="card-text"><strong>Assunto:</strong> ${post.assunto}</p>
                    <p class="card-text">${post.conteudo}</p>
                    <p class="card-text text-muted"><small>${post.data_hora}</small></p>
                </div>
            </div>
        `;
        postsContainer.appendChild(postCard);
    });
}

postForm.addEventListener('submit', async function (event) {
    event.preventDefault();

    const post = {
        titulo: document.getElementById('titulo').value,
        subtitulo: document.getElementById('subtitulo').value,
        assunto: document.getElementById('assunto').value,
        imagem: document.getElementById('imagem').value,
        conteudo: document.getElementById('conteudo').value
    };

    const response = await fetch(baseUrl + '/add_post', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
    });

    if (response.ok) {
        postForm.reset();
        carregarPosts();
    } else {
        alert('Erro ao adicionar post. Tente novamente.');
    }
});

carregarPosts();
