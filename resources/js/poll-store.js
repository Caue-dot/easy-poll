const container = document.getElementById('alternatives-container');
const addButton = document.getElementById('add-input');


addButton.addEventListener('click', () => {
    const div = document.createElement('div');
    div.className = 'input-group';

    div.innerHTML = `
            <input class="border rounded-sm border-gray-300   p-1.5" name="alternatives[]" placeholder="Alternativa">
        `;

    container.appendChild(div);
});



