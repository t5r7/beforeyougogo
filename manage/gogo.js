async function fetchEntries() {
    let j = await (await fetch(`../lib/list_entries.php`)).json();
    if(j.error) return document.getElementById('js-out').innerHTML = `<p>There was an error: <br>${j.error}</b></p>`;

    let tableRows = ``;

    for(let entry of j) {
        tableRows += `
            <tr>
                <td class="s">${entry['source']}</td>
                <td class="d"><a href="href="${entry['dest']}"">${entry['dest']}</a></td>
                <td class="a"><a href="javascript:deleteEntry('${entry['source']}')" class="button red">Delete</td>
            </tr>
        `
    }

    if(j.length === 0) {
        tableRows += `<tr><td class="s"><b>Could not find any entries</b></td><td class="d">Why not create one?</td><td class="a">&nbsp;</td></tr>`;
    }

    let output = `
        <table>
            <thead>
                <th class="s">Source</th>
                <th class="d">Destination</th>
                <th class="a">Actions</th>
            </thead>

            <tbody>
                ${tableRows}
            </tbody>
        </table>
    `;
        
    return document.getElementById('js-out').innerHTML = output;
}

async function deleteEntry(sourceURL) {
    let j = await (await fetch(`../lib/remove_entry.php?source=${sourceURL}`)).json();

    if(j.error) return alertAndRefresh(`Error Deleting:\n${j.error}`);
    if(j.success) return alertAndRefresh(`Success Deleting:\n${j.success}`);
    return alertAndRefresh(`Not sure if we were able to delete that, maybe try again?`);
}

async function addEntry(sourceURL, destURL) {
    let j = await (await fetch(`../lib/add_entry.php?source=${sourceURL}&dest=${destURL}`)).json();

    if(j.error) return alertAndRefresh(`Error Adding:\n${j.error}`);
    if(j.success) return alertAndRefresh(`Success Adding:\n${j.success}`);
    return alertAndRefresh(`Not sure if we were able to add that, maybe try again?`);
}

function addEntryWithInputs() {
    return addEntry(document.getElementById('in-source').value,document.getElementById('in-dest').value)
}

function wasItEnterAndShouldWeDoTheThingMaybeIDunno(e) {
    if(e.keyCode === 13) {
        e.preventDefault();
        return addEntryWithInputs();
    }
}

function alertAndRefresh(alertContent) {
    alert(alertContent);
    return window.location.reload();
}

fetchEntries();
document.getElementById('in-source').addEventListener('keyup', wasItEnterAndShouldWeDoTheThingMaybeIDunno);
document.getElementById('in-dest').addEventListener('keyup', wasItEnterAndShouldWeDoTheThingMaybeIDunno);
