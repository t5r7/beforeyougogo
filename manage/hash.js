if(window.location.hash) {
    processHash(window.location.hash.replace('#',''));
}

function clearHash() {
    window.location.hash = '';
}

function processHash(h) {
    clearHash();

    if(h.startsWith('add')) {
        let toAdd = h.split('add')[1];
        toAdd = atob(toAdd);
        
        let whereToGo = prompt(`Where should ${toAdd} redirect to?`);
        if(!whereToGo) return alert(`You didn\'t enter anything for ${toAdd}!`);

        return addEntry(toAdd, whereToGo);
    }

    if(h.startsWith('remove')) {
        let toDel = h.split('remove')[1];
        toDel = atob(toDel);
        
        if(prompt(`Type\n"${toDel}"\nbelow to confirm removal`) !== toDel) {
            return alert('You did not enter the verification correctly.\nYou may remove the URL from the usual admin page.')
        } else {
            return deleteEntry(toDel);
        }
    }
}

