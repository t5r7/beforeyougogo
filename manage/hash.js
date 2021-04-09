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
}

