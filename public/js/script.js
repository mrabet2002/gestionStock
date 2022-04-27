let tableSearch = document.querySelector('#table-search');
let result = document.querySelector('.lable-ts');
const rows = document.querySelectorAll('tbody')[0].rows;
const tbody = document.querySelector('tbody')
let table = document.getElementById('table');
let fournisseursJSON = JSON.parse(document.querySelector('.fournisseurs').innerHTML);
console.log(fournisseursJSON.find(fournisseur => fournisseur.num_fournisseur == "1"))
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

/* Array.from(rows).find(row => row.cells[1].innerText == 1).cells[1].innerText */
tableSearch.addEventListener('keyup', function show() {

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
    
    /* set cell6 data */
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



    
})