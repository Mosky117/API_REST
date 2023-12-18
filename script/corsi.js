function generaCorsi(){
    fetch('corso/read.php',{
        method: 'POST',
        headers:{
            'Content-Type':'application/json'
        }
    }).then(res=>res.json())
    .then(data=>{
        creaTabella(data);
    })
    
}

generaCorsi();

function creaTabella(data){
    const tabella= document.querySelector('.righe-corsi');
    // console.log(data);
    for(let key in data){
        if(data.hasOwnProperty(key)){
            let materie= data[key].slice(2).join(', ');
            let riga=`
            <tr>
                <td>${key}</td>
                <td>${data[key][1]}</td>
                <td>${materie}</td>
                <td>
                    <button class="btn" onclick="modificaCorso('${data[key][0]}')">Modifica</button>
                    <button class="btn" onclick="eliminaCorso('${data[key][0]}')">Elimina</button>
                </td>
            </tr>
            `;
            tabella.insertAdjacentHTML('beforeend', riga);
            // console.log(data[key][0]);
        }
    }
}

function modificaCorso(id){
    const modulo= document.createElement('div');
    modulo.innerHTML=`
        <div class="form-box">
            <button id="chiudiForm">X</button>
            <form class="form" action="corso/update.php" method="post">
            
            <input class="idCorso" type="text" id="idCorso" name="idCorso" value="${id}" readonly>
            
            <label for="nome">Nome Corso:</label><br>
            <input type="text" id="nome" name="nome"><br>
            
            <label for="posti">Numero Posti:</label><br>
            <input type="number" id="posti" name="posti"><br>
    
            <label for="materie">Materie:</label><br>
            <input type="text" id="materie" name="materie"><br>
    
            <button type="submit">Aggiorna corso</button>
            </form>
        </div>
    `;
    document.body.appendChild(modulo);
    const chiudiFormButton = modulo.querySelector('#chiudiForm');
    chiudiFormButton.addEventListener('click', function() {
        modulo.remove();
    });

}

function eliminaCorso(id){
    if(confirm('Sei sicuro di voler procedere?')){
        fetch('corso/delete.php',{
            method: 'POST',
            headers:{
                'Content-type':'application/json'
            },
            body: JSON.stringify({id:id})
        }).then(res=>{
            if(res.ok){
                const tab=document.querySelector('.righe-corsi');
                tab.innerHTML='';
                generaCorsi();
            }else{
                console.log('Errore durante l\neliminazione');
            }
        }).catch(e=>{
            console.error('Errore nella richiesta di eliminazione');
        })
    }
    
}

function ricerca(){
    let param = document.getElementById('parametro').value;
    let val = document.getElementById('value').value; 
    fetch('corso/search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ parametro: param, valore: val })
    })
    .then(response => response.json())
    .then(data => {
        const tabella= document.querySelector('.righe-corsi');
        tabella.innerHTML='';
        creaTabella(data);
    })
    .catch(error => {
        console.error('Si è verificato un errore durante la ricerca:', error);
    });
}