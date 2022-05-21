/* let tableSearch = document.querySelector('#table-search');
let result = document.querySelector('.lable-ts');
const rows = document.querySelectorAll('tbody')[0].rows;
const tbody = document.querySelector('tbody')
let table = document.getElementById('table');
let fournisseursJSON = JSON.parse(document.querySelector('.fournisseurs').innerHTML);
console.log(fournisseursJSON.find(fournisseur => fournisseur.num_fournisseur == "1")) */
/* function parseHTMLTableElem(tableEl) {
    const columns = Array.from(tableEl.querySelectorAll('thead th')).map(it => it.textContent)
    const rows = tableEl.querySelectorAll('tbody tr')
    return Array.from(rows).map(row => {
        const cells = Array.from(row.querySelectorAll('td'))
        return columns.reduce((obj, col, idx) => {
            obj[col] = cells[idx].textContent
            return obj
        }, {})
    })
} */
/* function parseHTMLTableElem(tableEl) {
    const rows = tableEl.querySelectorAll('tbody tr')
    return Array.from(rows).map(row => {
        const cells = Array.from(row.querySelectorAll('td')).map(cell => cell.textContent)
        return cells.reduce((obj, col, idx) => {
            obj[col] = cells[idx].textContent
            return obj
        }, {})
    })
} */

const { replace } = require("lodash")

/* Array.from(rows).find(row => row.cells[1].innerText == 1).cells[1].innerText */


/* tableSearch.addEventListener('keyup', function show() {

    let fournisseur = fournisseursJSON.find(fournisseur => fournisseur.num_fournisseur == tableSearch.value)
    tbody.innerHTML = ""
    const newRow = document.createElement('tr')
    newRow.setAttribute('class', 'cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600')
    
    
    
    const cell1 = document.createElement('td')
    const cell2 = document.createElement('td')
    const cell3 = document.createElement('td')
    const cell4 = document.createElement('td')
    const cell5 = document.createElement('td')
    const cell6 = document.createElement('td')
    
    
    cell1.setAttribute('class', 'w-4 px-4')
    cell2.setAttribute('class', 'px-6 py-4 font-medium text-gray-900 dark:text-white')
    cell3.setAttribute('class', 'px-6 py-4')
    cell4.setAttribute('class', 'px-6 py-4')
    cell5.setAttribute('class', 'px-6 py-4')
    cell6.setAttribute('class', 'py-4 flex justfy-between')
    
    
    cell1.innerHTML = '<div class="flex items-center"><input id="checkbox-table-search-'+fournisseur.id+'" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></div>'
    cell2.innerHTML = fournisseur.num_fournisseur;
    cell3.innerHTML = fournisseur.name
    cell4.innerHTML = fournisseur.email
    cell5.innerHTML = fournisseur.pays
    
    const showFournisseurLink = document.createElement('a')
    const editFournisseurLink = document.createElement('a')
    const deleteFournisseurLink = document.createElement('a')

    showFournisseurLink.setAttribute('href', "http://gestionstock.test/fournisseur/afficher/"+fournisseur.id )
    showFournisseurLink.setAttribute('class', "px-3 text-indigo-500 transition" )
    showFournisseurLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
    
    editFournisseurLink.setAttribute('href', "http://gestionstock.test/fournisseur/modifier-fournisseur/"+fournisseur.id )
    editFournisseurLink.setAttribute('class', "px-3 edit-btn transition" )
    editFournisseurLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg>';
    
    deleteFournisseurLink.setAttribute('data-modal-toggle', "supprimerfournisseur" )
    deleteFournisseurLink.setAttribute('class', "delete-product px-3 text-red-500 delete-btn transition" )
    deleteFournisseurLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg>';
    
    cell6.appendChild(showFournisseurLink)
    cell6.appendChild(editFournisseurLink)
    cell6.appendChild(deleteFournisseurLink)
    
    newRow.appendChild(cell1)
    newRow.appendChild(cell2)
    newRow.appendChild(cell3)
    newRow.appendChild(cell4)
    newRow.appendChild(cell5)
    newRow.appendChild(cell6)
    tbody.appendChild(newRow);



    
})  */

/* const addLigneAchatBtn = document.getElementById('ajouterLigneAchat')


addLigneAchatBtn.addEventListener('click', function () {
    const tbody = document.querySelector('tbody')
    const rowCount = document.getElementsByTagName('tbody')[0].rows.length
    const newRow = document.createElement('tr')
    const LigneCommandeRow = document.getElementById('LigneCommandeRow')
    const deleteButton = '<button id="element'+rowCount+'" type="button" class="delete-product hover:bg-red-500 hover-text-white border rounded-md py-1 px-3 text-red-500 transition">X</button>'
    const tbodyLastChild = tbody.lastElementChild;
    const input1Name = tbodyLastChild.cells[0].firstElementChild.firstElementChild.getAttribute('name')
    let inputCount;
    if (rowCount == 1) {
        inputCount = 1
    }else{
        inputCount = parseInt(input1Name.replace('lignesAchat[element','').replace('][id_produit]','')) + 1
    }

    newRow.setAttribute('class', 'cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600')
    newRow.setAttribute('id', "element"+rowCount)
    newRow.innerHTML = LigneCommandeRow.innerHTML
    newRow.cells[0].firstElementChild.firstElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][id_produit]')
    newRow.cells[1].firstElementChild.firstElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][prix]')
    newRow.cells[2].firstElementChild.firstElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][qte]')
    newRow.cells[3].firstElementChild.lastElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][remise]')
    newRow.cells[4].firstElementChild.firstElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][date_expiration]')
    newRow.cells[5].firstElementChild.firstElementChild.setAttribute('name', 'lignesAchat[element'+inputCount+'][total]')
    newRow.lastElementChild.innerHTML = deleteButton;
    
    //alert(LigneCommandeRow.cells[1].firstElementChild.firstElementChild.getAttribute('name'))
    tbody.appendChild(newRow);
    const deleteLigneAchatBtn = document.querySelectorAll('.delete-product')
    deleteLigneAchatBtn.forEach(element => {
    element.addEventListener('click', removeRow)
});

})

const deleteLigneAchatBtn = document.querySelectorAll('.delete-product')
deleteLigneAchatBtn.forEach(element => {
    element.addEventListener('click', removeRow)
}); */
function ajouterLigneVente(event) {
    if (event.target.checked == true) {
        let body = document.querySelector('.table-lignesvente-body')
        const ligneVente = document.querySelector('tr#'+event.target.getAttribute('id'))
        body.appendChild(ligneVente)
    }else{
        let body = document.querySelector('.table-produits-body')
        const ligneVente = document.querySelector('tr#'+event.target.getAttribute('id'))
        body.appendChild(ligneVente)
    }
}

function dragStart(event) {
    event.dataTransfer.setData('text/plain', event.target.id);
    setTimeout(()=>{
        event.target.classList.add('hidden')
    }, 0)
}
function dragEnd(event) {
    event.target.classList.remove('hidden')
}
function dragEnter(event) {
    let dropZoneTop = document.getElementById('drop-zone-top')
    event.preventDefault()
    dropZoneTop.classList.remove('hidden')
    dropZoneTop.classList.add('drag-over');
}

function dragOver(event) {
    let dropZoneTop = document.getElementById('drop-zone-top')
    event.preventDefault()
    dropZoneTop.classList.remove('hidden')
    dropZoneTop.classList.add('drag-over');
}

function dragLeave(event) {
    let dropZoneTop = document.getElementById('drop-zone-top')
    dropZoneTop.classList.add('hidden');
    dropZoneTop.classList.remove('drag-over');
}

function drop(event) {
    let dropZoneTop = document.getElementById('drop-zone-top')
    let dropZone = document.getElementById('drop-zone')
    dropZoneTop.classList.add('hidden')
    dropZone.classList.remove('drag-over');
    dropZone.classList.add('ligne-produit');

    // get the draggable element
    const id = event.dataTransfer.getData('text/plain');
    const draggable = document.getElementById(id);
    if ((Array.from(dropZone.rows).find(row => row.getAttribute('id') == id.replace('produit-', 'ligneVente-'))) == undefined) {
        for (let i = 0; i < 6; i++) {
            draggable.cells[i].classList.remove('hidden');
        }
        draggable.cells[1].firstElementChild.firstElementChild.setAttribute('name', 'lignesVente['+id.replace('produit-', '')+'][prix]')
        draggable.cells[2].firstElementChild.firstElementChild.setAttribute('name', 'lignesVente['+id.replace('produit-', '')+'][qte_demandee]')
        draggable.cells[3].firstElementChild.lastElementChild.setAttribute('name', 'lignesVente['+id.replace('produit-', '')+'][remise]')
        draggable.cells[4].firstElementChild.firstElementChild.setAttribute('name', 'lignesVente['+id.replace('produit-', '')+'][date_expiration]')
        draggable.cells[5].firstElementChild.firstElementChild.setAttribute('name', 'lignesVente['+id.replace('produit-', '')+'][total]')
        draggable.cells[5].firstElementChild.firstElementChild.classList.add('total-input')
        draggable.setAttribute('id', id.replace('produit-', 'ligneVente-'))
        // add it to the drop target
        
        dropZone.appendChild(draggable);
        // display the draggable element
    }
    draggable.classList.remove('hidden');
}
function SourceDragEnter(event) {
    let dropZoneTop = document.getElementById('source-zone-top')
    event.preventDefault()
    dropZoneTop.classList.remove('hidden')
    dropZoneTop.classList.add('drag-over');
}

function SourceDragOver(event) {
    let dropZoneTop = document.getElementById('source-zone-top')
    event.preventDefault()
    dropZoneTop.classList.remove('hidden')
    dropZoneTop.classList.add('drag-over');
}

function SourceDragLeave(event) {
    let dropZoneTop = document.getElementById('source-zone-top')
    dropZoneTop.classList.add('hidden');
    dropZoneTop.classList.remove('drag-over');
}

function SourceDrop(event) {
    let dropZoneTop = document.getElementById('source-zone-top')
    let dropZone = document.getElementById('source-zone')
    dropZoneTop.classList.add('hidden')
    dropZone.classList.remove('drag-over');
    dropZone.classList.remove('ligne-produit');

    // get the draggable element
    const id = event.dataTransfer.getData('text/plain');
    console.log(event.dataTransfer.getData('text/plain'))
    const draggable = document.getElementById(id);
    for (let i = 0; i < 6; i++) {
        if (i > 0) {
            draggable.cells[i].classList.add('hidden');
        }
    }
    draggable.cells[1].firstElementChild.firstElementChild.setAttribute('name', '')
    draggable.cells[2].firstElementChild.firstElementChild.setAttribute('name', '')
    draggable.cells[3].firstElementChild.lastElementChild.setAttribute('name', '')
    draggable.cells[4].firstElementChild.firstElementChild.setAttribute('name', '')
    draggable.cells[5].firstElementChild.firstElementChild.setAttribute('name', '')
    draggable.cells[5].firstElementChild.firstElementChild.classList.remove('total-input')
    let repeatedChild = Array.from(dropZone.rows).find(row => row.getAttribute('id') == id.replace('ligneVente-', 'produit-'))
    if (repeatedChild != undefined) {
        dropZone.removeChild(repeatedChild)
    }
    draggable.setAttribute('id', id.replace('ligneVente-', 'produit-'))
    // add it to the drop target
    dropZone.appendChild(draggable);
    // display the draggable element
    draggable.classList.remove('hidden');
}


function removeRow(event) {
    const rows = document.querySelectorAll('tbody')[0].rows;
    const tbodyChild = Array.from(rows).find(row => row.getAttribute('id') == event.target.getAttribute('id'))
    tbodyChild.cells[2].firstElementChild.firstElementChild.value = 0
    tbodyChild.cells[3].firstElementChild.lastElementChild.value = 0
}

function calculatTotal(event, bodyClass, inputRemiseId) {
    const rows = document.querySelectorAll('.'+bodyClass)[0].rows;
    const tbodyChild = Array.from(rows).find(row =>  event.target.getAttribute('name').includes('['+row.getAttribute('id').replace('ligneVente-', '')+']'))
    const prixInput = tbodyChild.cells[1].firstElementChild.firstElementChild
    const totalInput = tbodyChild.cells[5].firstElementChild.firstElementChild
    const qteInput = tbodyChild.cells[2].firstElementChild.firstElementChild
    const remiseInput = tbodyChild.cells[3].firstElementChild.lastElementChild
    totalInput.setAttribute('value', Math.round(((prixInput.value) * (qteInput.value))*(1 - (remiseInput.value)/100)*100)/100)
    remiseGlobal(inputRemiseId)
}
function remiseGlobal(inputRemiseId) {
    const prixTotal = document.getElementById('prix-total')
    const totalInputAll = document.querySelectorAll('.total-input')
    console.log(totalInputAll)
    const remiseGlobalInput = document.getElementById(inputRemiseId)
    let total = 0
    totalInputAll.forEach(element => {
        if (element.value) {
            total += parseFloat(element.value)
        }
    });
    prixTotal.setAttribute('value', Math.round((total*(1-(remiseGlobalInput.value)/100))*100)/100)
}

const fournisseurList = document.getElementById('fournisseur')

fournisseurList.addEventListener('change', filtreProduit)

function filtreProduit() {
    const rows = document.querySelectorAll('tbody')[0].rows;
    const options = document.getElementsByTagName('option')
    const deviseInput = document.getElementById('devise')
    const totalDevise = document.getElementById('total-devise')
    let devise = Array.from(options).find(option => option.value == this.value).getAttribute('devise')
    deviseInput.value = devise
    totalDevise.innerText = devise
    const noRowFound = document.getElementById('noRowFound')
    const rowFound = Array.from(rows).map(row => row.firstElementChild.value != this.value && this.value ? row.style.display = "none" : row.style.display = "table-row" )
    rowFound.find(display => display == 'table-row') == undefined ? noRowFound.style.display = 'table-row' : noRowFound.style.display = 'none' 
}

function defaultProperties(event) {
    const options = document.getElementsByTagName('option')
    const deviseInput = document.getElementById('devise')
    const adresseInput = document.getElementById('adresse_livraison')
    const totalDevise = document.getElementById('total-devise')
    let selectedOption = Array.from(options).find(option => option.value == event.target.value)
    let devise = selectedOption.getAttribute('devise')
    let adresse = selectedOption.getAttribute('adresse')
    deviseInput.value = devise
    adresseInput.value = adresse
    totalDevise.innerText = devise
}

function resetValue(event) {
    if (event.target.value == 0) {
        event.target.setAttribute('value', "")
    }
}
function chercherLigne(event, bodyClass, cellIndex) {
    const rows = document.querySelectorAll('.'+bodyClass)[0].rows;
    const chercherPar = document.querySelectorAll('.filtrer-par')
    if (Array.from(chercherPar).find(radio => radio.checked)) {
        cellIndex = Array.from(chercherPar).find(radio => radio.checked).value
    }
    Array.from(rows).map(row => {
        row.cells[cellIndex].innerText.toLowerCase().includes(event.target.value.toLowerCase()) ? row.style.display = 'table-row' : row.style.display = 'none'
    })
}


function trierString(event, cellIndex, bodyClass) {
    
    const rows = document.querySelectorAll('.'+bodyClass)[0].rows;
    const tbody = document.querySelectorAll('.'+bodyClass)
    const ordre = event.target.getAttribute('ordre')
    switch (ordre) {
        case 'asc':
            lignesTrier = Array.from(rows).sort((a,b) => {
                if (a.cells[cellIndex].innerText.toLowerCase() < b.cells[cellIndex].innerText.toLowerCase()) {
                    return 1;
                }else{
                    return -1;
                }
            })
            event.target.setAttribute('ordre', 'desc')
            event.target.style.transform = "rotate(180deg)";
            break;
        case 'desc':
            
            lignesTrier = Array.from(rows).sort((a,b) => {
                if (a.cells[cellIndex].innerText.toLowerCase() > b.cells[cellIndex].innerText.toLowerCase()) {
                    return 1;
                }else{
                    return -1;
                }
            })
            event.target.setAttribute('ordre', 'asc')
            event.target.style.transform = "rotate(0deg)";
            break;
    }
    
    tbody[0].innerHTML = "" 
    lignesTrier.map(ligne => tbody[0].appendChild(ligne))
    
}
function trierNum(event, cellIndex) {
    const rows = document.querySelectorAll('tbody')[0].rows;
    const tbody = document.querySelectorAll('tbody')
    const ordre = event.target.getAttribute('ordre')
    switch (ordre) {
        case 'asc':
            lignesTrier = Array.from(rows).sort((a,b) => {
                if (parseInt(a.cells[cellIndex].innerText) < parseInt(b.cells[cellIndex].innerText)) {
                    return 1;
                }else{
                    return -1;
                }
            })
            event.target.setAttribute('ordre', 'desc')
            event.target.style.transform = "rotate(180deg)";
            break;
        case 'desc':
            
            lignesTrier = Array.from(rows).sort((a,b) => {
                if (parseInt(a.cells[cellIndex].innerText) > parseInt(b.cells[cellIndex].innerText)) {
                    return 1;
                }else{
                    return -1;
                }
            })
            event.target.setAttribute('ordre', 'asc')
            event.target.style.transform = "rotate(0deg)";
            break;
        default:
            break;
    }
    
    tbody[0].innerHTML = "" 
    lignesTrier.map(ligne => tbody[0].appendChild(ligne))
}

function checkAllToggel(event) {
    let checkboxs = document.querySelectorAll('.checkboxs')
    if (event.target.checked == true) {
        Array.from(checkboxs).map(checkbox => checkbox.checked = true)
    }else if(event.target.checked == false){
        Array.from(checkboxs).map(checkbox => checkbox.checked = false)
    }
}


