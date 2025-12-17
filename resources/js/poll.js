
const successMessage = document.getElementById('success-message');
const errorMessage = document.getElementById('error-message')
const copyLink = document.getElementById('copy-link');
function getVotesSpan(id) {
    const item = document.querySelector(
        `#poll-list li[data-id="${id}"]`
    )
    return item ? item.querySelector('.votes') : null
}

function disableButtons(){
    const pollList = document.getElementById('poll-list');
    const buttons = pollList.querySelectorAll('button');
    buttons.forEach(button => {
        button.disabled = true;
    })
}


const sendVote = (id) => {
    console.log(id);
    axios.post(`/votes/${id}`)
        .then(() => {
            const votesSpan = getVotesSpan(id)
            votesSpan.textContent = String(parseInt(votesSpan.textContent) + 1)
            disableButtons();
            errorMessage.textContent = ""
            successMessage.textContent = "Votado com sucesso!";
        })
        .catch((error)=> {
            console.log(error);
            successMessage.textContent = ""
            errorMessage.textContent = error.response.data.message
        });
}


document.getElementById('poll-list').addEventListener('click', (e) => {
    if(e.target.id && e.target.id.startsWith('vote-')){
        const alternativeId = e.target.dataset.alternativeId;
        sendVote(alternativeId)
    }
})

copyLink.addEventListener('click', async () => {
    const textContent = copyLink.textContent;
    await navigator.clipboard.writeText(copyLink.textContent);
    copyLink.textContent = "Copiado com sucesso!"
    setTimeout(() => {
        copyLink.textContent = textContent
    }, 1000)
});


window.sendVote = sendVote

window.Echo.channel('vote-cast')
    .listen('.user.voted', (e) => {
        const votesSpan = getVotesSpan(e.id)
        votesSpan.textContent = e.votesCount
    })
