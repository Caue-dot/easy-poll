
const successMessage = document.getElementById('success-message');
const errorMessage = document.getElementById('error-message')
const copyLink = document.getElementById('copy-link');
function getVotesSpan(id) {
    const item = document.querySelector(
        `#poll-list li[data-id="${id}"]`
    )
    return item ? item.querySelector('.votes') : null
}

function changeButtonsState(state){
    const pollList = document.getElementById('poll-list');
    const buttons = pollList.querySelectorAll('button');
    buttons.forEach(button => {
        button.disabled = state;
    })
}



const sendVote = (id) => {
    console.log(id);
    const votesSpan = getVotesSpan(id)
    votesSpan.textContent = String(parseInt(votesSpan.textContent) + 1)
    changeButtonsState(true);


    axios.post(`/votes/${id}`)
        .then(() => {
            errorMessage.textContent = ""
            successMessage.textContent = "Votado com sucesso!";
        })
        .catch((error)=> {
            console.log(error);
            votesSpan.textContent = String(parseInt(votesSpan.textContent) - 1)
            successMessage.textContent = ""
            errorMessage.textContent = error.response.data.message
            changeButtonsState(false);
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
