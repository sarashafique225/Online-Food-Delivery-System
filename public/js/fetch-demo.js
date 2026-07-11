// Fetch album titles from JSONPlaceholder API
async function loadAlbums() {
    const list = document.getElementById('album-list');
    list.innerHTML = '<li>Loading...</li>';

    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/albums');
        const albums = await response.json();

        list.innerHTML = '';
        albums.forEach(album => {
            const li = document.createElement('li');
            li.textContent = album.title;
            list.appendChild(li);
        });
    } catch(error) {
        list.innerHTML = '<li>Error loading data</li>';
    }
}

document.addEventListener('DOMContentLoaded', loadAlbums);
