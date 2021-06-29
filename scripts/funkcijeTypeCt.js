// kad se izabe tip1 da se prikazu svi timovi 

const typeCompetition=document.getElementById("typect");
const tableSelectParticipant=document.getElementById("tabelaIzborUcesnika");
const randomNames=new Array("pica","pasta","bolognese");

typeCompetition.onchange=ListenerParticipants; 


//participantsBasedOnType();






function PrikaziTeam(team)
{
    console.log("Usao u prikazi team");
    console.log(team);
    //var tm=JSON.parse(JSON.stringify(team));
    //console.log(tm);
    var tableBody=tableSelectParticipant.getElementsByTagName('tbody')[0];
    //tableBody.innerHTML+="<tr><td>"+tm["name"]+"</td></tr>";
    

    team.forEach(tm => {
        tableBody.innerHTML+="<tr><td>"+tm["name"]+"</td></tr>";
        
    });
    console.log("izasao u prikazi team");


    
}


function  ListenerParticipants()
{
    console.log("usao u ListenerParticipants");
    var typeComp=typeCompetition.value;
    //tabelaIzborUcesnika();

    if(typeComp=='1')
    {
        fetch("jsonFje/getParentTeams.php")
        .then(res=>{
            console.log(res);
            if(!res.ok)
                throw Error(res.status);
            return res.json();
        })
        .then(team=>tableSelectParticipants(team,'name','team_id')) //ovde navodis kako ti je zapravo u bazi napisano name, id i sta sve treba od parametara
        .catch(err=>console.log(err));
    }
    else if(typeComp=='2')
    {
        
    }

}

function tableSelectParticipants(participantsList,name,id)
{
    console.log('U fji izbor ucesnika');
    console.log(tableSelectParticipant);
    tableSelectParticipant.innerHTML=
    "<thead><tr>\n\
    <th>Name</th> <th>btns</th>  </tr></thead><tbody>  </tbody>";

    var tableBody=tableSelectParticipant.getElementsByTagName('tbody')[0];
  //  console.log(tableBody);
    participantsList.forEach( elem=>{
        tableBody.innerHTML+="<tr><td>"+elem[name]+"</td><td><button name='addParticipant' id="+elem[id]+">Add </button></td></tr>";
    });

    const btnsAddParticipant=document.getElementsByName("addParticipant");
    btnsAddParticipant.forEach(btn=>{
        eventAddParticipant(btn);
    })
    

}

function eventAddParticipant(btn) //eventIzmeni u D fajlu 
    {

        btn.onclick=(ev)=>{
            let idParticipant=parseInt(btn.id);
            console.log("liknut btn i id tog elementa je:",btn.id);

        }
        
    }

