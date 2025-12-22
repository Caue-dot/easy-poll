const container = document.getElementById('alternatives-container');
const errorMessage = document.getElementById('error-message')
const addButton = document.getElementById('add-input');


addButton.addEventListener('click', () => {

    if(container.childElementCount >= 10){
        errorMessage.textContent = "Você atingiu o limite de alternativas!"
        return;
    }
    const div = document.createElement('div');
    div.className = 'input-group';

    div.innerHTML = `
            <input class="border rounded-sm border-gray-300   p-1.5" name="alternatives[]" placeholder="Alternativa">
        `;

    container.appendChild(div);
});



