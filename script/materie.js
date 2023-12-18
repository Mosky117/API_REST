function generaMaterie(){
    fetch('materia/read.php',{
        method: 'POST',
        headers:{
            'Content-Type':'application/json'
        }
    }).then(res=>res.json())
    .then(data=>{
        console.log(data);
        const tabella= document.querySelector('.righe-materie');
        for(let key in data){
            if(data.hasOwnProperty(key)){
                let nome= data[key].slice(1);
                let riga=`
                <tr>
                    <td>${nome}</td>
                    <td>
                        <button class="btn" onclick="modificaMateria('${data[key][0]}')">Modifica</button>
                        <button class="btn" onclick="eliminaMateria('${data[key][0]}')">Elimina</button>
                    </td>
                </tr>
                `;
                tabella.insertAdjacentHTML('beforeend', riga);
            }
        }
    })
}
generaMaterie();

function creaMateria(){
    const modulo= document.createElement('div');
    modulo.innerHTML=`
        <div class="form-box">
            <button id="chiudiForm">X</button>
            <form class="form" id="form" action="materia/create.php" method="post">
        
            <label for="nome">Nome Materia:</label><br>
            <input type="text" id="nome" name="nome"><br>
    
            <button type="submit">Crea materia</button>
            </form>
        </div>
    `;
    document.body.appendChild(modulo);
    const chiudiFormButton = modulo.querySelector('#chiudiForm');
    chiudiFormButton.addEventListener('click', function() {
        modulo.remove();
    });
}

function aggiornaTabella(){
    
}

function modificaMateria(id){
    const modulo= document.createElement('div');
    modulo.innerHTML=`
        <div class="form-box">
            <button id="chiudiForm">X</button>
            <form class="form" action="materia/update.php" method="post">
                <input class="idMateria" type="text" id="idMateria" name="idMateria" value="${id}" readonly>
                <label for="nome">Nome Materia:</label><br>
                <input type="text" id="nome" name="nome"><br>
                <button type="submit">Aggiorna materia</button>
            </form>
        </div>
    `;
    document.body.appendChild(modulo);
    const chiudiFormButton = modulo.querySelector('#chiudiForm');
    chiudiFormButton.addEventListener('click', function() {
        modulo.remove();
    });
}

function eliminaMateria(id){
    if(confirm('Sei sicuro di voler procedere?')){
        fetch('materia/delete.php',{
            method: 'POST',
            headers:{
                'Content-type':'application/json'
            },
            body: JSON.stringify({id:id})
        }).then(res=>{
            if(res.ok){
                const tab=document.querySelector('.righe-materie');
                tab.innerHTML='';
                generaMaterie();
            }else{
                console.log('Errore durante l\neliminazione');
            }
        }).catch(e=>{
            console.error('Errore nella richiesta di eliminazione');
        })
    }
}